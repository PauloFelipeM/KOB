<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'country', 'country_acronym',
    ];

    protected $hidden = [];

    //Relationships
    public function cards(){
        return $this->hasMany(Card::class, 'country_id');
    }
    //Methods 
}
