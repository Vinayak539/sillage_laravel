<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TxnCustomField extends Model 
{

    protected $table = 'txn_custom_fields';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(TxnProduct::class);
    }

}