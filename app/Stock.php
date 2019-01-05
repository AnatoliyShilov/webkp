<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /**
     * Get the product record associated with the order
     */
    public function productRec()
    {
        return $this->belongsTo('App\Product', 'product');
    }
}
