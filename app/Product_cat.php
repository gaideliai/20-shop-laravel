<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_cat extends Model
{
    public function productRelation() 
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function catRelation() 
    {
        return $this->belongsTo('App\Cat', 'cat_id', 'id');
    }
}
