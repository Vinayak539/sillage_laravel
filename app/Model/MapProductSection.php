<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MapProductSection extends Model 
{

    protected $table = 'map_product_sections';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(TxnProduct::class);
    }

}