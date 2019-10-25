<?php

namespace App;

use App\Category;
use App\Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the images for the blog post.
     */
    public function images(){
        return $this->belongsToMany('App\Image','product_images');
    }

    public function image(){
        return $this->hasOne(Image::class,'id','principal_image');
    }
}
