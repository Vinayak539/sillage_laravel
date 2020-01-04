<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MapMstOfferProduct extends Model
{
    protected $guarded = ['id'];

    public function mst_offer()
    {
        return $this->belongsTo(MstOffer::class);
    }
}
