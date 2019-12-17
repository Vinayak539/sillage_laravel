<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TxnMaterial extends Model 
{

    protected $table = 'txn_materials';
    protected $guarded = ['id'];
    public $timestamps = true;

}