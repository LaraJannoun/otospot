<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';

	protected $fillable = [
        'maintenance_mode',
        'image',
        'title',
        'text',
        'secret'
    ];

    public function getImageAttribute($value){
        return $value ? asset($value) : null;
    }
}
