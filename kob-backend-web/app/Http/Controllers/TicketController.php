<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Ticket;
use App\Access;
use App\Card;
use App\ServiceType;
use App\Workspace;

class TicketController extends Controller
{

    public function charge($id){

        $ticket = Ticket::find($id);

        if($ticket->payment_done){
            exit;
        } 

        $ticket->payment_status = ''; 

        if(!$ticket->card->card_square_id){
            $ticket->payment_status = __('card.no_card_square_id');        
            $ticket->save();
            return back();
        }
        

        $charge = Card::chargeCard($ticket->id);

        print_r($charge);
        
        return back();

    }

    protected $rules = array(
        'scheduled_date' => ['required', 'date'],
        'origin_address' => ['required', 'string'],    
        'service_type_id' => ['required'],
        'card_id' => ['required'],
    );

    protected function messages(){
        return array(
            'employee_id.required'   => __("customvalidation.employee_required"),
            'service_type_id.required' => __("customvalidation.service_type_required"),
            'card_id.required' => __("customvalidation.card_required"),
        );
    } 

    public function index(){
        $tickets = Ticket::index();

        return view('tickets.index', array(
            'tickets' => $tickets,
        ));
    }

    public function create($access_id){
        $employees = Access::get_workspace_employees();        
        $service_types = ServiceType::get_workspace_services();
        $cards = Card::where('access_id', $access_id)->get();        

        return view('tickets.create', array(
            'employees' => $employees,
            'service_types' => $service_types,
            'cards' => $cards,
            'access_id' => $access_id,
            'services_types' => Ticket::services_types(),
        ));
    }

    public function update($id, $access_id){
        $employees = Access::get_workspace_employees(); 
        $service_types = ServiceType::get_workspace_services();
        $cards = Card::where('access_id', $access_id)->get();
        $ticket = Ticket::find($id);

        if($ticket->payment_done){
            exit;
        }

        return view('tickets.update', array(
            'employees' => $employees,
            'service_types' => $service_types,       
            'cards' => $cards,
            'access_id' => $access_id,
            'ticket' => $ticket,
            'services_types' => Ticket::services_types(),
        ));
    }

    public function store(Request $request, $id = ""){


        $data = $request->all();

        if(empty($id)){                    
            $this->validate(request(), $this->rules, $this->messages());    
        }

        $data['scheduled_date'] = $data['scheduled_date'].' '.$data['scheduled_date_time'];
        
        if(!empty($id)){            
            $ticket = Ticket::find($id);
            $ticket->update($data);
        }else{            
            $ticket = new Ticket();
            $workspace = Workspace::getCurrentWorkspace();
            $ticket->fill($data); 
            $ticket->workspace_id = $workspace->id;
            $ticket->save();
        }

        return Redirect::to('tickets');
    }

    public function delete(Ticket $ticket){        
        if($ticket->payment_done){
            exit;
        } 
        $ticket->delete();
        return Redirect::to('tickets');
    }

    public function start($id){
        Ticket::start($id);
        return Redirect::to('tickets');
    }

    public function finish($id){
        Ticket::finish($id);
        return Redirect::to('tickets');
    }

    public function calculate_price(){
        $ticket = new Ticket();
        $rate = $ticket->calculate_rate();
        return $rate;
    }
}
