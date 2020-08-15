<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Access;
use App\Workspace;
use App\User;

class WorkspaceAccessController extends Controller
{
    protected $rules = array(  
        'email' => 'required|string|max:168',  
    );

    public function index()
    {            
        $workspace = Workspace::getCurrentWorkspace();        
        $access = Access::index($workspace->id);
        return view('workspace_accesses.index', array(
            'accesses' => $access,
        ));
    }

    public function create(){
        return view('workspace_accesses.create');
    }

    public function update($id){
        return view('workspace_accesses.update', array(
            'access' => Access::find($id),
        ));
    }

    public function store(Request $request, $id = "")
    {        
        if(!$id) $this->validate($request, $this->rules);    

        $data = $request->all();
        $data['is_admin'] = $request->is_admin ? 1 : 0;
        $data['is_manager'] = $request->is_manager ? 1 : 0;
        $data['is_blocked'] = $request->is_blocked ? 1 : 0;
        $data['is_employee'] = $request->is_employee ? 1 : 0;

        if($id){
            $access = Access::find($id);
            $access->update($data);
        }else{
            $user = User::where('email', $request->email)->first();
            if(!$user){
                $explode = explode('@', $request->email);
                $user = new User();
                $user->name = $explode[0];
                $user->email = $request->email;
                $user->password = rand(100000,999999);
                $user->save();
            }
            $workspace = Workspace::getCurrentWorkspace();
            $access = new Access();
            $access->workspace_id = $workspace->id;
            $access->user_id = $user->id;
            $access->fill($data);
        }
        $access->save();
        return Redirect::to('workspace_accesses');
    }
}
