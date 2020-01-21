<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(TxnUser::class);
    }
}
