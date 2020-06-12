<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    //
    protected $fillable = ['name'];
    protected $visible =[ 'id','name',] ;
}
