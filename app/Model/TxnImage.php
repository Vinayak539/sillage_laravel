<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TxnImage extends Model 
{

    protected $table = 'txn_images';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(TxnProduct::class);
    }
}