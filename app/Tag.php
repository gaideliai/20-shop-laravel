<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function product_tag()
    {
        return $this->hasMany('App\Product_tag', 'tag_id', 'id');
    }
}
