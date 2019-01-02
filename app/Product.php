<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Get the comments for the product
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'product');
    }

    /**
     * Get the images for the product
     */
    public function images()
    {
        return $this->hasMany('App\Image', 'product');
    }

    /**
     * Get the type record associated with the product
     */
    public function typeRec()
    {
        return $this->belongsTo('App\Type', 'type');
    }
}
