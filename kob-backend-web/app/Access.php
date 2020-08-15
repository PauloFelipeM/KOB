<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'accesses';

    protected $fillable = ['user_id', 'workspace_id', 'is_admin', 'is_manager', 'is_blocked', 'is_employee'];

    //Relationships
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cards(){
        return $this->hasMany(Card::class, 'access_id');
    }
    
    public function workspace(){
        return $this->belongsTo(Workspace::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class, 'access_id');
    }

    //Methods
    static function list($workspace_id, $admin_only=false){
        $accesses = Access::query();
        $accesses = $accesses->where('workspace_id', $workspace_id);        
        if($admin_only){
            $accesses = $accesses->where('is_admin', 1);
        }        
        $model = array();
        foreach ($accesses->get() as $access) {
            $access->access_display = $access->user->name.' - '.$access->user->email; 
            $model[] = $access;
        }
        return $model;
    }

    public static function index($workspace_id){
        $accesses = Access::query();
        $accesses = $accesses->where('workspace_id', $workspace_id);
        if(request()->search){
            $accesses = $accesses->whereHas('user', function($q){
                $q->where('name', 'like', '%'.request()->search.'%');
                $q->orWhere('email', 'like', '%'.request()->search.'%');
            });
        }
        $accesses = $accesses->paginate(15);
        return $accesses;
    }

    public static function get_workspace_employees(){
        $access_id = \AccessSession::getAccessId();                   
        $access = Access::find($access_id);        
        $employees = Access::where('workspace_id', $access->workspace_id)->where('is_employee', 1)->get();
        return $employees;
    }

}
