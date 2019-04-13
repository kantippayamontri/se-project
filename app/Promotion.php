<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    protected $fillable = [
        'name','description','now_number','number','min_money','percent','discount','picture','point',
    ];
}
