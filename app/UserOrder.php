<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    /**
     * The table associated with the order.
     * 
     * @var string
     */
    protected $table = 'userorders';

    /**
     * Get the user record associated with the order
     */
    public function userRec()
    {
        return $this->belongsTo('App\User', 'user');
    }

     /**
      * Get the delivery type record associated with the order
      */
    public function deliveryTypeRec()
    {
        return $this->belongsTo('App\DeliveryType', 'deliverytype');
    }

    /**
     * Get the pay type record associated with the order
     */
    public function payTypeRec()
    {
        return $this->belongsTo('App\PayType', 'paytype');
    }

    /**
     * Get status record associated with the order
     */
    public function statusRec()
    {
        return $this->belongsTo('App\Status', 'status');
    }
}
