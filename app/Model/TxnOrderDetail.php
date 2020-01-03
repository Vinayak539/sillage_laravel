<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TxnOrderDetail extends Model
{

    protected $table = 'txn_order_details';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function order()
    {
        return $this->belongsTo(TxnOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(TxnProduct::class);
    }

    public function map_color_sizes()
    {
        return $this->belongsTo(MapColorSize::class);
    }

    public function size()
    {
        return $this->belongsTo(MstSize::class);
    }

    public function color()
    {
        return $this->belongsTo(MstColor::class);
    }

}
