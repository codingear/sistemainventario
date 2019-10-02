<?php

namespace App;

use App\Category;
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
    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
