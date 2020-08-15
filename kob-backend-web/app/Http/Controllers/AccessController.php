<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Access;
use App\Workspace;
use App\User;

class AccessController extends Controller
{

    protected $rules = array(  
        'email' => 'required|string|max:168',  
    );

    public function index($workspace_id)
    {
        return view('accesses.index', array(
            'accesses' => Access::index($workspace_id),
            'workspace' => Workspace::find($workspace_id),
        ));
    }

    public function create($workspace_id){
        return view('accesses.create', array(
            'workspace_id' => $workspace_id,
        ));
    }

    public function update($id){
        return view('accesses.update', array(
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
            if($user){
                $data['user_id'] = $user->id;
                $access = new Access();
                $access->fill($data);
            }else{
                return Redirect::to('accesses/create/'.$request->workspace_id)->withError(__('messages.user_not_found'));
            }        
        }
        $access->save();
        return Redirect::to('accesses/'.$access->workspace_id);
    }
}
