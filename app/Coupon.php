<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    protected $fillable = [
        'id','code','user_id','name','picture','description','min_money','percent','discount',
    ];
}

