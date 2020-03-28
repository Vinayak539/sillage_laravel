<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['product_id', 'user_id', 'color_id', 'size_id'];
}
