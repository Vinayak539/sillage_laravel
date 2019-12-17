<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TxnProduct extends Model
{

    protected $table   = 'txn_products';
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(TxnCategory::class, 'category_id');
    }

    public function warranty()
    {
        return $this->belongsTo(MasterWarranty::class);
    }

    public function side_product()
    {
        return $this->belongsTo(SideProduct::class, 'id', 'product_id');
    }

    public function custom_fields()
    {
        return $this->hasMany(TxnCustomField::class, 'product_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo(TxnColor::class);
    }

    public function sizes()
    {
        return $this->belongsTo(TxnSize::class, 'product_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(TxnImage::class, 'product_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(TxnReview::class, 'product_id', 'id');
    }

    public function qnas()
    {
        return $this->hasMany(ProductFaq::class, 'product_id', 'id');
    }

    public function weight()
    {
        return $this->belongsTo(TxnWeight::class);
    }

    public function condition()
    {
        return $this->belongsTo(TxnCondition::class);
    }

    public function master_gst()
    {
        return $this->belongsTo(TxnMasterGst::class, 'gst', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(TxnBrand::class);
    }

    public function material()
    {
        return $this->belongsTo(TxnMaterial::class);
    }

    public function keywords()
    {
        return $this->hasMany(TxnKeyword::class, 'product_id', 'id');
    }

    public function section()
    {
        return $this->hasMany(MapProductSection::class, 'product_id', 'id');
    }

    public function topSection()
    {
        return $this->hasMany(MapProductToTopSection::class, 'product_id', 'id');
    }

}
