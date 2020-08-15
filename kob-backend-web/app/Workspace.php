<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    protected $table = 'workspaces';

    protected $fillable = ['title', 'domain', 'disabled', 'address', 'id_number', 'phone', 'contact', 'email'];

    protected $appends = ['admin_list'];

    //Relationships
    public function accesses(){
        return $this->hasMany(Access::class, 'workspace_id');
    }

    public function service_types(){
        return $this->hasMany(ServiceType::class, 'workspace_id');
    }

    public function tickets(){
        return $this->hasMany(Ticket::class, 'workspace_id');
    }

    //Attributes
    public function getAdminListAttribute(){
        $admin_list = Access::list($this->id, true);
        return $admin_list;
    }

    //Methods
    public static function index(){
        $workspaces = Workspace::query();

        if(request()->search){
            $workspaces = $workspaces->where('title', 'like', '%'.request()->search.'%');
        }
        
        $workspaces = $workspaces->orderBy('created_at', 'desc');
        $workspaces = $workspaces->paginate(15);
        return $workspaces;
    }

    public static function getCurrentWorkspace(){
        $access_id = \AccessSession::getAccessId();           
        if($access_id){
            $access = Access::find($access_id);
            $workspace = Workspace::find($access->workspace_id);
            return $workspace;
        }
    }
}
