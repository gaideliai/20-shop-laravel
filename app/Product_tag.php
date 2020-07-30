<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_tag extends Model
{
    public function productRelation()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function tagRelation()
    {
        return $this->belongsTo('App\Tag', 'tag_id', 'id');
    }
}
