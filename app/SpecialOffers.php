<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialOffers extends Model
{
    //
    protected $table = 'special_offers';

    public function villa()
    {
        return $this->belongsTo('App\Villa');
    }

}	
