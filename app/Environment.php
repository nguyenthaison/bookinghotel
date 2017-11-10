<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    //
    protected $table = 'environments';
    protected $fillable = ['title', 'slug', 'description'];

    public function villa()
    {
        return $this->hasMany('App\Villa');
    }
}
