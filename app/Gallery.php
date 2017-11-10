<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    protected $table = 'galleries';

    public function villa()
    {
        return $this->belongsTo('App\Villa');
    }
}
