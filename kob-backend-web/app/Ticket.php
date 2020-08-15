<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    protected $table = 'tickets';
    use SoftDeletes;

    protected $fillable = [
        'access_id', 'employee_id', 'card_id', 'service_type_id', 'workspace_id', 'amount', 'tip_amount', 'scheduled_date',
        'transit_start', 'transit_finish', 'payment_status', 'origin_address', 'origin_coordinates',
        'service_type', 'number_hours', 'additional_commments',
    ];

    protected $hidden = [];

    protected $appends = [
        'status',
    ];

    // Relationships
    public function serviceType(){
        return $this->belongsTo(ServiceType::class);
    }

    public function access(){
        return $this->belongsTo(Access::class, 'access_id');
    }

    public function employee(){
        return $this->belongsTo(Access::class, 'employee_id');
    }

    public function card(){
        return $this->belongsTo(Card::class);
    }

    public function workspace(){
        return $this->belongsTo(Workspace::class);
    }

    //Attributes
    public function getStatusAttribute(){

        if($this->transit_start && $this->transit_finish){
            $status = date('H:i', strtotime($this->transit_start)). ' - ' .date('H:i', strtotime($this->transit_finish));
        }else if($this->transit_start && !$this->transit_finish){
            $status = __('ticket.started');
        }else{
            $status = null;
        }

        return $status;
    }

    //Helpers
    public static function services_types($index = null){
        $services = array(
            1 => __('ticket.point_to_point'),
            2 => __('ticket.hourly'),
        );

        if($index) return $services[$index];
        else return $services;
    }

    //Methods
    public static function index(){
        $tickets = Ticket::query();
        $workspace = Workspace::getCurrentWorkspace();
        $tickets = $tickets->where('workspace_id', $workspace->id);
        if(request()->search){
            $tickets = $tickets->where('scheduled_date', request()->search);
        }
                
        $tickets = $tickets->orderBy('created_at', 'desc');
        $tickets = $tickets->paginate(15);

        return $tickets;
    }

    public static function start($id){
        $ticket = Ticket::find($id);
        $ticket->transit_start = \Carbon\Carbon::now();
        $ticket->save();
    }

    public static function finish($id){
        $ticket = Ticket::find($id);
        $ticket->transit_finish = \Carbon\Carbon::now();
        $ticket->save();
    }

    public function calculate_rate(){        
        $serviceType = ServiceType::where('id', request()->service_type_id)->first();

        $rate = 0;
        if(request()->service_type == 1){
            $rate = $this->calculate_mileage_rate(request()->miles, $serviceType->first_span, 
                                            $serviceType->first_span_rate, $serviceType->next_span, 
                                            $serviceType->next_span_rate, $serviceType->remaining_span_rate);                                            
        }else if(request()->service_type == 2){
            $rate = $this->calculate_hourly_rate(request()->minutes, $serviceType->hourly_amount, $serviceType->min_hours);
        }

        return $rate;
    }

    private function calculate_mileage_rate($miles=0, $mileage_count_1, $mileage_rate_1, $mileage_count_2, $mileage_rate_2, $mileage_rate_3){        
        $rate = 0;
        if($miles<=$mileage_count_1){
            $rate = $miles*$mileage_rate_1;
        }elseif($miles<=($mileage_count_1+$mileage_count_2)){
            $rate = $mileage_rate_1*$mileage_count_1;
            $remaining_miles = $miles - $mileage_count_1;
            $rate = $rate+($remaining_miles*$mileage_rate_2);
        }else{
            $rate = ($mileage_rate_1*$mileage_count_1) + ($mileage_rate_2*$mileage_count_2);
            $remaining_miles = $miles - ($mileage_count_2 - $mileage_count_1);
            $rate = $rate+($remaining_miles*$mileage_rate_3);
        }
        return round($rate, 2);
    }
    
    private function calculate_hourly_rate($minutes=0, $hourly_rate, $min_hourly_rate){              
        $rate = 0;
        $rate = $hourly_rate * $minutes/60;
        return $rate<$min_hourly_rate?round($min_hourly_rate, 2):round($rate, 2);
    }
    
}
