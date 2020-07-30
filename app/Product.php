<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getImages()
    {
        return $this->hasMany('App\Image', 'product_id', 'id');
    }

    public function getCat()
    {
        return $this->hasMany('App\Product_cat', 'product_id', 'id');
    }

    public function getTag()
    {
        return $this->hasMany('App\Product_tag', 'product_id', 'id');
    }

}
