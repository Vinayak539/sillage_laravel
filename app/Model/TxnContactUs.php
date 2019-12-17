<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TxnContactUs extends Model 
{

    protected $table = 'txn_contact_us';
    public $timestamps = true;
    protected $guarded = ['id'];

}