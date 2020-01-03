<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Shop extends Authenticatable
{
    protected $guarded = ['id'];

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
}
