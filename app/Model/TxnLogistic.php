<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class TxnLogistic extends Authenticatable 
{

    protected $table = 'txn_logistics';

    protected $guarded = ['id'];

    public $timestamps = true;

    protected $hidden = [
        'password',
    ];

}