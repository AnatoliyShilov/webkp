<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
    * Get the user record associated with the comment
    */
    public function userRec()
    {
        return $this->belongsTo('App\User', 'user');
    }
}
