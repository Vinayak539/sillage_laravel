<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TxnCategory extends Model 
{
    protected $guarded = ['id'];

    public function pcategory()
    {
        return $this->belongsTo(TxnCategory::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(TxnProduct::class, 'category_id', 'id');
    }
   
}