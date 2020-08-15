<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Workspace;

class WorkspaceController extends Controller
{

    protected $rules = array(
        'title' => 'required|string|max:255',        
        'domain' => 'required|string|max:255',
        'address' => 'required',
        'id_number' => 'required|string|max:32',
        'phone' => 'required|string|max:64',
        'contact' => 'required|string|max:255',  
        'email' => 'required|string|max:168',  
    );

    public function index()
    {
        $workspaces = Workspace::index();
        return view('workspaces.index', array(
            'workspaces' => $workspaces,
        ));
    }

    public function view($id){
        return view('workspaces.view', array(
            'workspace' => Workspace::find($id),
        ));
    }

    public function create(){
        return view('workspaces.create');
    }

    public function update($id){
        return view('workspaces.update', array(
            'workspace' => Workspace::find($id),
        ));
    }

    public function store(Request $request, $id = "")
    {   
        $this->validate($request, $this->rules);
        $data = $request->all();
        $data['disabled'] = $request->disabled ? 1 : 0;        
        
        if(!empty($id)){            
            $workspace = Workspace::find($id);
            $workspace->update($data);
        }else{            
            $workspace = new Workspace();
            $workspace->fill($data); 
            $workspace->save();
        }

        return Redirect::to('workspaces');
    }

    public function delete(Workspace $workspace){        
        $workspace->delete();       
        return Redirect::to('workspaces'); 
    }
}
