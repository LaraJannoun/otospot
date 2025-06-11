<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsSetting extends Model
{
	protected $fillable = [
        'logo',
        'primary_color'
    ];

    public function getLogoAttribute($value){
        return $value ? asset($value) : null;
    }
}
