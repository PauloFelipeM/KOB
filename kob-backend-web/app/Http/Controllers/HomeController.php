<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Card;
use App\Access;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $access_id = \AccessSession::getAccessId();
        $page = $access_id ? 'dashboard' : 'select_workspace';

        return Redirect::to($page);
    }

    public function dashboard(){
        $access_id = \AccessSession::getAccessId();        
        if($access_id){
            $cards = Card::whereNull('card_square_id')->get();
            
            return view('dashboards.dashboard', array(
                'cards' => $cards
            ));
        }else{
            return Redirect::to('select_workspace');
        }
    }

    public function select_workspace(){
        $accesses = Access::where('user_id', auth()->user()->id)->get();

        return view('dashboards.select_workspace', array(
            'accesses' => $accesses
        ));
    }

    public function signin_workspace($id){        
        if($id){
            \Session::put('access_id', $id);
            return Redirect::to('dashboard');
        }     
    }

    public function signout_workspace(){
        \Session::forget('access_id');
        return Redirect::to('dashboard');
    }
}
