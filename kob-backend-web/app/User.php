<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'active', 'role', 'phone_number', 'api_token', 'access_code',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relationships

    public function accesses(){
        return $this->hasMany(Access::class, 'user_id');
    }

    //Attributes
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }

    //Methods
    public static function index()
    {                  
        $users = User::query();
        if(request()->search){
             $users = $users->where('name', 'like', '%'.request()->search.'%')
             ->orWhere('email', 'like', '%'.request()->search.'%');
        }   
        $users = $users->orderBy('created_at', 'desc');        
        $users = $users->paginate(15);
                
        return $users;        
    }

    public static function roles(){
        return array(
            'admin' => __('user.admin'), 
            'user' => __('user.user'),
        );
    }
}
