<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSectionImage extends Model
{
    protected $table = 'home_section_images';

    public function HomeSection()
    {
        return $this->belongsTo(HomeSection::class, 'home_section_id');
    }
}
