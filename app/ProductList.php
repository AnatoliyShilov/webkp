<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'productlists';

    /**
     * Get the product record associated with the prodact list
     */
    public function productRec()
    {
        return $this->belongsTo('App\Product', 'product');
    }
}
