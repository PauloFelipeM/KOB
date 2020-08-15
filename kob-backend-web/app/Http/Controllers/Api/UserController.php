<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;

class UserController extends APIController
{
    public function index(Request $request)
    {            
        try {                        
            $users = User::all();        
            return self::responseSuccess($users, 'Successfully listed users');
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }     
    }
}