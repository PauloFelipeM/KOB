<?php

namespace App\Http\Controllers\Api;

use App\CarType;
use Illuminate\Http\Request;

class CarTypeController extends APIController
{
    public function index(Request $request)
    {            
        try {   
            if (auth()->user()) {                
                $car_types = CarType::all();
                return self::responseSuccess($car_types, 'Successfully listed car types');
            }                        
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }     
    }
}