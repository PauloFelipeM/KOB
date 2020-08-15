<?php
namespace App\Helpers;

use App\Workspace;
use App\Access;

class AccessSession {
    public static function getAccessId(){
        $access_id = \Session::get('access_id');
        if($access_id){
            return $access_id;
        }
        return '';
    }
    public static function getWorkspaceName(){
        $access_id = \AccessSession::getAccessId();           
        if($access_id){
            $access = Access::find($access_id);
            $workspace = Workspace::find($access->workspace_id);
            return $workspace->title;
        }
    }
}