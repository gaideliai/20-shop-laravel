<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    public function product_cat()
    {
        return $this->hasMany('App\Product_cat', 'cat_id', 'id');
    }
}
