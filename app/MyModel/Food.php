<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    //
    public function category()
    {
        return $this->belongsTo('App\Model\Category','category_id','id');
    }
}
