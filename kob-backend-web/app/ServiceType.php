<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceType extends Model
{
    protected $table = 'service_types';
    use SoftDeletes;

    protected $fillable = [
        'workspace_id', 'title', 'amount_value', 'hourly_amount', 'min_hourly_rate', 'first_span', 'first_span_rate',
        'next_span', 'next_span_rate', 'remaining_span_rate', 'original_filename', 'storage_filename',
    ];

    protected $hidden = [];

    //Relationships
    public function workspace(){
        return $this->belongsTo(Workspace::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class, 'service_type_id');
    }

    //Methods
    public static function index()
    {                  
        $access_id = \AccessSession::getAccessId();                   
        $access = Access::find($access_id); 

        $service_types = ServiceType::query();
        $service_types = $service_types->where('workspace_id', $access->workspace_id);
        if(request()->search){
             $service_types = $service_types->where('title', 'like', '%'.request()->search.'%');
        }  
        $service_types = $service_types->orderBy('created_at', 'desc');        
        $service_types = $service_types->paginate(15);
                        
        return $service_types;        
    }    

    public static function get_workspace_services(){
        $access_id = \AccessSession::getAccessId();                   
        $access = Access::find($access_id); 

        $service_types = ServiceType::query();
        $service_types = $service_types->where('workspace_id', $access->workspace_id);  
        return $service_types->get();
    }
}
