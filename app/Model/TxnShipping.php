<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TxnShipping extends Model 
{

    protected $table = 'txn_shippings';
    
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo('TxnOrder');
    }

}