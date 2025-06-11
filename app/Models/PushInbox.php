<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class PushInbox extends Model
{
	use HasTranslations;

	protected $table = "push_inbox";

	protected $fillable = [
		'user_id',
		'subject',
		'message',
		'image',
		'type'
	];

	public $translatable = [
        'subject',
        'message'
    ];

	protected $casts = [
        'created_at'  => 'date:M d Y'
    ];

	public function getImageAttribute($value){
		return $value ? asset($value) : null;
	}

	/*
    * RELATIONS
    */

	public function PushRead(){
		return $this->hasMany(UserPushInbox::class, 'push_inbox_id', 'id');
	}
}
