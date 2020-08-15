<?php

namespace App\Http\Controllers\Api;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends APIController
{
    protected $rules = array(
        'scheduled_date' => ['required', 'date'],
        'origin_address' => ['required', 'string'],    
        'car_type_id' => ['required'],
        'card_id' => ['required'],
        'amount' => 'required',
        'origin_coordinates' => 'required',
        'service_type' => 'required',
    );

    protected function messages(){
        return array(
            'car_type_id.required' => __("customvalidation.car_type_required"),
            'card_id.required' => __("customvalidation.card_required"),
        );
    }

    public function index()
    {            
        try {                        
            $tickets = Ticket::where('user_id', auth()->user()->id)->with('car', 'driver')->orderBy('id', 'desc'); 
            return self::responseSuccess($tickets->get(), 'Successfully listed tickets');
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }     
    }

    public function calculate_price(){        
        try {                        
            $ticket = new Ticket();
            $rate = $ticket->calculate_rate();            
            return self::responseSuccess($rate, 'Successfully calculate price');
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }  
    }

    public function create(Request $request){
        $this->validate(request(), $this->rules, $this->messages());

        try {
            $data = $request->all();  
            if(!$data['destination_address']) $data['destination_address'] = $data['origin_address'];
            if(!$data['destionation_coordinates']) $data['destionation_coordinates'] = $data['origin_coordinates'];            
            $ticket = new Ticket();
            $ticket->fill($data); 
            $ticket->user_id = auth()->user()->id;
            $ticket->number_passengers = $data['number_passengers'] ? $data['number_passengers'] : 1;
            $ticket->luggage_count = $data['luggage_count'] ? $data['luggage_count'] : 0;
            $ticket->child_seat = $data['child_seat'] ? $data['child_seat'] : 0;
            $ticket->number_hours = $data['number_hours'] ? $data['number_hours'] : 0;
            $ticket->save();

            return self::responseSuccess($ticket, 'Successfully create ticket');
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }
    }
}