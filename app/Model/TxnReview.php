<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TxnReview extends Model 
{
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->belongsTo(TxnUser::class);
    }

    public function product()
    {
        return $this->belongsTo(TxnProduct::class);
    }

}