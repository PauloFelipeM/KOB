<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [
        'state', 'state_acronym',
    ];

    protected $hidden = [];

    //Relationships
    public function cards(){
        return $this->hasMany(Card::class, 'state_id');
    }
    //Methods 
}
