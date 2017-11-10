<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bedroom extends Model
{
    //
    protected $fillable = ['title', 'slug', 'number'];

    public function villas()
    {
        return $this->belongsToMany('App\Villa');
    }

    public function rate()
    {
        return $this->hasMany('App\Rate');
    }
}