<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    //
    protected $table = 'seasons';
    protected $fillable = ['title', 'slug'];

    public function rate()
    {
        return $this->hasMany('App\Rate');
    }
}
