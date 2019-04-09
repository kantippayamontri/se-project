<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $fillable = [
        'product_id', 'name','price', 'point','total_price','total_point','picture','quantity'
    ];
}
