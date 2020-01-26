<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MapMstOfferProduct extends Model
{
    protected $guarded = ['id'];

    public function mst_offer()
    {
        return $this->belongsTo(MstOffer::class, 'offer_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(TxnProduct::class, 'offer_product_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo(MstColor::class, 'color_id', 'id');
    }

    public function size()
    {
        return $this->belongsTo(MstSize::class, 'size_id', 'id');
    }
}
