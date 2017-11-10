<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    protected $table = 'areas';
    protected $fillable = ['title', 'slug', 'region_id'];

    /**
    * Get the Region for the area.
    */
    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function villa()
    {
        return $this->hasMany('App\Villa');
    }
}
