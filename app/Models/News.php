<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'id',
        'image',
        'title',
        'text',
        'date',
        'publish'
    ];

    protected $hidden = [
        'id',
        'publish',
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function(Builder $builder) {
            $builder->orderBy('date', 'desc');
        });
    }

    public function scopeGeneralScope($query){
        return $query->wherePublish(1);
    }

    public function setDateAttribute($value){
        $timestamp = \Carbon\Carbon::createFromFormat('d/m/Y', $value)->timestamp;
        $this->attributes['date'] = date('Y/m/d', $timestamp);
    }

    public function getImageAttribute($value){
        return $value ? asset($value) : null;
    }

    public function getDateAttribute($value){
        return date('d M Y', strtotime($value));
    }

    public function getCreatedAtAttribute($value){
        return date('d M Y - h:i A', strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('d M Y - h:i A', strtotime($value));
    }
}
