<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MapProductMstSize extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(TxnProduct::class);
    }

    public function size()
    {
        return $this->belongsTo(MstSize::class);
    }
}
