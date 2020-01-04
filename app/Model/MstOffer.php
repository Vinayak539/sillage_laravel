<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MstOffer extends Model
{
    protected $guarded = ['id'];

    public function map_offers()
    {
        return $this->hasMany(MapMstOfferProduct::class, 'offer_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(TxnCategory::class);
    }

    public function offerproduct()
    {
        return $this->belongsTo(TxnProduct::class, 'offer_product_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo(MstColor::class);
    }

    public function size()
    {
        return $this->belongsTo(MstSize::class);
    }
}
