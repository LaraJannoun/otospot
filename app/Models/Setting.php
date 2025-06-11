<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $fillable = [
        'android_app',
        'apple_app'
    ];
}
