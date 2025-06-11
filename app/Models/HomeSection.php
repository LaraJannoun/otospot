<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class HomeSection extends Model
{
    protected $fillable = [
        'slug',
        'title_en',
        'text_en',
        'title_ar',
        'text_ar',
        'subtitle_en',
        'subtitle_ar',
    ];

    // protected $hidden = [
    //     'id',
    //     'slug',
    //     'created_at',
    //     'updated_at'
    // ];

    public function images(){
        return $this->hasMany(HomeSectionImage::class, 'home_section_id', 'id')->orderBy('pos', 'asc');
    }

    public function getCreatedAtAttribute($value){
        return date('d M Y - h:i A', strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('d M Y - h:i A', strtotime($value));
    }
}
