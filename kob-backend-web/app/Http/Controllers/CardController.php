<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Card;
use App\Access;
use App\State;
use App\Country;

class CardController extends Controller
{
    protected $rules = array(
        'name' => 'required|string|max:150',
        'number' => 'required',
        'expiration' => 'required',
        'code' => 'required',
        'card_address_postal_code' => 'required',
        'card_address_city' => 'required',
        'card_address' => 'required',
        'state_id' => 'required',
        'country_id' => 'required',        
    );

    protected function messages(){
        return array(
            'state_id.required' => __('customvalidation.state_required'),
            'country_id.required' => __('customvalidation.country_required'),
        );
    }

    public function index($access_id)
    {
        $cards = Card::index($access_id);
        $access = Access::find($access_id);

        return view('cards.index', array(
            'cards' => $cards,
            'access' => $access,
        ));
    }


    public function validate_card($id){

        $validate = Card::validateCard($id);

        $card = Card::find($id);
        return view('cards.validate', array(
            'card' => $card,
        ));
    }

    public function view($id){
        $card = Card::find($id);
        return view('cards.view', array(
            'card' => $card,
        ));
    }

    public function create($access_id){    

        return view('cards.create', array(
            'access_id' => $access_id,
            'states' => State::all(),
            'countries' => Country::all(),
        ));
    }

    public function update($id){

        $card = Card::find($id);

        return view('cards.update', array(
            'card' => $card,
            'states' => State::all(),
            'countries' => Country::all(),
        ));
    }

    public function store(Request $request, $id = "")
    {                       
        $this->validate(request(), $this->rules, $this->messages());   
        $data = $request->all(); 
        
        if(!empty($id)){            
            $card = Card::find($id);   
            $card->update($data);   
        }else{
            $card = new Card();            
            $card->fill($data);
            $card->access_id = $request->access_id;
            $card->active = 1;
            $card->save();
        }

        return Redirect::to('cards/'.$card->access_id);
    }

    public function delete(Card $card){        
        $card->delete();
        return Redirect::to('cards/'.$card->access_id);
    }
}
