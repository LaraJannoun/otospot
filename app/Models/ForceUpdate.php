<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForceUpdate extends Model
{
	protected $table = 'force_update';

	protected $fillable = [
        'title',
        'text',
        'android_version',
        'force_update_android',
        'ios_version',
        'force_update_ios'
    ];
}
