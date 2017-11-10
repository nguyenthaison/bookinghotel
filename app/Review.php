<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = 'reviews';
    protected $fillable = ['villa_id', 'guest_name', 'comments'];

    public function villa()
    {
        return $this->belongsTo('App\Villa');
    }

    /**
    * Get the Country for the area.
    */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
