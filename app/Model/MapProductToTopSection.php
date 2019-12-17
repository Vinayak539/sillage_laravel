<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MapProductToTopSection extends Model
{
    protected $guarded = ['id'];

    public function section()
    {
        return $this->belongsTo(TopMasterSection::class, 'section_id', 'id');
    }
   
    public function product()
    {
        return $this->belongsTo(TxnProduct::class, 'product_id', 'id');
    }

}
