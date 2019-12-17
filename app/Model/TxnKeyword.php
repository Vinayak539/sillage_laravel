<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TxnKeyword extends Model 
{

    protected $table = 'txn_keywords';
    protected $guarded = ['id'];  

    public function product()
    {
        return $this->belongsTo(TxnProduct::class, 'product_id', 'id');
    }
}