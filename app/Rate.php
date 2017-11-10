<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    //

    /**
    * Get the Villa for the rate post.
    */
    public function villa()
    {
        return $this->belongsTo('App\Villa');
    }

    /**
    * Get the Villa for the rate post.
    */
    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    /**
    * Get the Bedroom for the rate post.
    */
    public function bedroom()
    {
        return $this->belongsTo('App\Bedroom');
    }
}
