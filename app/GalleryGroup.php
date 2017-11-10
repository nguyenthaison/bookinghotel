<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryGroup extends Model
{
    //
    protected $table = 'gallery_groups';
    protected $fillable = ['title'];
}
