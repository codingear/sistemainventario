<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->belongsToMany('App\Product','product_images');
    }
}
