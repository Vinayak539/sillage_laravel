<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MsSection extends Model 
{

    protected $table = 'ms_sections';

    protected $guarded = ['id'];

    public function msections()
    {
        return $this->hasMany(MapProductSection::class, 'section_id', 'id');
    }
    
}