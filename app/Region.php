<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $table = 'regions';
    protected $fillable = ['title', 'slug', 'country_id'];

    /**
    * Get the Country for the area.
    */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function area()
    {
        return $this->hasMany('App\Area');
    }
}
