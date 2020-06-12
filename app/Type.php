<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    protected $visible=[
        'id','type','name'
    ];
    protected $fillable = ['name','type'];
}
