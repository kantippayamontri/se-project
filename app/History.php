<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //
    protected $fillable = [

        'cart', 'time', 'user_id', 'name', 'quantity', 'total_price', 'total_point'
        
    ];
}
