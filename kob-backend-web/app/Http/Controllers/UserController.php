<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\User;
use Auth;

class UserController extends Controller
{
    protected $rules_create = array(
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:4', 'confirmed'],
    );

    protected $rules_update = array(
        'name' => ['required', 'string', 'max:255'],
        'role' => 'required',
        'email' => ['required', 'string', 'email', 'max:255'],
    );

    protected function messages(){
        return array(
            'role.required' => __('customvalidation.role_required'),
        );
    } 

    public function index()
    {
        $users = User::index();

        return view('users.index', array(
            'users' => $users,
        ));
    }

    public function view($id){
        $user = User::find($id);
        $roles = User::roles();        
        return view('users.view', array(
            'user' => $user,
            'roles' => $roles,
        ));
    }

    public function create(){
        $roles = User::roles();        
        return view('users.create', array(
            'roles' => $roles,
        ));
    }

    public function update($id){
        $user = User::find($id);
        $roles = User::roles();
        return view('users.update', array(
            'user' => $user,
            'roles' => $roles,
        ));
    }

    public function store(Request $request, $id = "")
    {        
        if(!empty($id)){            
            $this->validate(request(), $this->rules_update, $this->messages());
            $data = $request->all();

            $user = User::find($id);  
            $user->update($data);
        }

        return Redirect::to('users');
    }

    public function delete(User $user){
        $user->delete();
        return Redirect::to('users');
    }

    public function my_profile(){
        $user = User::find(Auth::user()->id);
        return view('users.my_profile', array(
            'user' => $user,
        ));
    }

    public function my_store(Request $request){

        $this->validate(request(), $this->rules_update);
        $data = $request->all();

        $user = User::find(Auth::user()->id);
        $user->update($data);        
        
        return Redirect::to('home');
    }
}
