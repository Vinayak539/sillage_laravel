<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TxnUser extends Authenticatable
{
    protected $guarded = ['id'];

    protected $dates = ['last_login', 'last_purchase'];

    public function orders()
    {
        return $this->hasMany(TxnOrder::class, 'user_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(TxnReview::class, 'user_id', 'id');
    }

}
