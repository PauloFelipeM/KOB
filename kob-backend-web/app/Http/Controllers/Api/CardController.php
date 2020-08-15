<?php

namespace App\Http\Controllers\Api;

use App\Card;
use Illuminate\Http\Request;

class CardController extends APIController
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

    public function index(Request $request)
    {            
        try {   
            if (auth()->user()) {                
                $cards = Card::where('user_id', auth()->user()->id)->get();        
                return self::responseSuccess($cards, 'Successfully listed cards');
            }                        
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }     
    }

    public function create(Request $request){
        $this->validate($request, $this->rules, $this->messages());
        try {                 
            $card = new Card();
            $card->fill($request->all());
            $card->user_id = auth()->user()->id;
            $card->active = 1;
            $card->save();

            return self::responseSuccess($card, 'Card created successfully');
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }     
    }

    public function delete(Card $card){
        try {                 
            $card->delete();
            return self::responseSuccess('', 'Card deleted successfully');
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }
    }
}