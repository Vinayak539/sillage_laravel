<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TxnWeight extends Model 
{

    protected $table = 'txn_weights';
    protected $guarded = ['id'];
    public $timestamps = true;

}