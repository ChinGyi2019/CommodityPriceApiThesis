<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Product extends Model implements JWTSubject
{
    //
    protected $visible =[ 'id','name', 'date', 'type','town','price','weight_unit'] ;
    protected $fillable = [

        'name', 'date','type','price','weight_unit','town'

    ];

    /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
       return $this->getKey();
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
