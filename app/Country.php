<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'countries';
    protected $fillable = ['title', 'slug'];

    public function region()
    {
        return $this->hasMany('App\Region');
    }

    public function user()
    {
        return $this->hasMany('App\User');
    }

    public function testimonial()
    {
        return $this->hasMany('App\Testimonial');
    }

    public function review()
    {
        return $this->hasMany('App\Review');
    }

}
