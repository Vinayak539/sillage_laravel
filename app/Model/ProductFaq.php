<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductFaq extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(TxnProduct::class, 'product_id', 'id');
    }
}
