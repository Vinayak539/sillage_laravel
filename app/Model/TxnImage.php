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

    public static function image($product_id,$color_id)
    {
        return self::select('image_url')->where('color_id', $color_id)->where('product_id', $product_id)->first();
    }
}