<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class FixedSection extends Model
{
    protected $fillable = [
        'slug',
        'title_en',
        'text_en',
        'title_ar',
        'text_ar'
    ];

    // protected $hidden = [
    //     'id',
    //     'slug',
    //     'created_at',
    //     'updated_at'
    // ];

    public function getCreatedAtAttribute($value){
        return date('d M Y - h:i A', strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('d M Y - h:i A', strtotime($value));
    }
}
