<?php

namespace App\Http\Controllers\Api;

use App\State;
use App\Country;
use Illuminate\Http\Request;

class AddressesController extends APIController
{
    public function states()
    {            
        try {                        
            $states = State::all();        
            return self::responseSuccess($states, 'Successfully listed states');
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }     
    }

    public function countries()
    {            
        try {                        
            $countries = Country::all();        
            return self::responseSuccess($countries, 'Successfully listed countries');
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }     
    }
}