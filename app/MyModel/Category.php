<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function foods()
    {
        return $this->hasMany('App\Model\Food');
        
    }
}
