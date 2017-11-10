<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';
    protected $fillable = ['villa_id', 'guest_name', 'comments'];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
