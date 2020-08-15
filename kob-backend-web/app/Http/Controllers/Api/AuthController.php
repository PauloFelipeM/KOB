<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Auth;
use App\User;

class AuthController extends APIController
{

    public function access_code(Request $request){
        $this->validate($request, array('email' => 'required|string|email|max:255'));
        try {
            $user = User::where('email', $request->email)->first();
            if($user){
                $user->access_code = rand(100000,999999);
                $user->save();

                return response()->json([
                    "status" => 200,
                    "success" => true,
                    "message" => "Verify you email",                    
                ]);
            }else{
                return response()->json([
                    "status" => 404,
                    "success" => false,
                    "message" => "User not found!",
                ]);
            }
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }  
    }
    
    public function login(Request $request){
       $this->validate($request, array('access_code' => 'required'));
        try {            
            $user = User::where('access_code', $request->access_code)->first();
            
            if($user){
                $user->access_code = null;
                $user->api_token = str_random(60);
                $user->save();

                return response()->json([
                    "status" => 200,
                    "success" => true,
                    "message" => "Successful login",
                    "user" => $user,
                ]);
            }else{
                return response()->json([
                    "status" => 401,
                    "success" => false,
                    "message" => "Invalid credentials!",
                ]);
            }
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }  
    }

    public function logout(Request $request){
        try {                        
            if (auth()->user()) {
                $user = auth()->user();
                $user->api_token = null;
                $user->save();

                return self::responseSuccess(null, __('api_validation.logout'));
            }
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }     
    }

    public function socials_login(Request $request){
        try {              
            
            if ($request->email && $request->name) {

                $user = User::where('email', $request->email)->first();
                
                if(!$user){
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->role = 'user';
                    $user->password = rand(100000,9999999);
                }
                $user->access_code = rand(100000,999999);                
                $user->save();
                
                return response()->json([
                    "status" => 200,
                    "success" => true,
                    "message" => "Verify you email",                      
                ]);
            }else{
                return response()->json([
                    "status" => 401,
                    "success" => false,
                    "message" => "Invalid credentials",                    
                ]);
            }
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }
    }

    public function register(Request $request){
        try {              
            
            if ($request->email && $request->name && $request->password) {
                
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->role = 'user';
                $user->password = $request->password;
                $user->access_code = rand(100000,999999);
                $user->save();
                
                return response()->json([
                    "status" => 200,
                    "success" => true,
                    "message" => "Verify you email",
                ]);
            }else{
                return response()->json([
                    "status" => 401,
                    "success" => false,
                    "message" => "Invalid credentials",                    
                ]);
            }
        } catch (\Exception $exception) {
            return self::responseError($exception->getMessage());
        }
    }

}