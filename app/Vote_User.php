<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote_User extends Model
{
    //
    protected $fillable = [
        'id','user_id','vote_id',
    ];

}
