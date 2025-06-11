<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'pin',
        'verificationID',
        'new_user',
        'password'
    ];

    protected $hidden = [
        'pin',
        'verificationID',
        'password',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function scopeGeneralScope($query){
        // return $query->whereBlocked(0)->whereVerified(1);
    }

    public function getCreatedAtAttribute($value){
        return date('d M Y - h:i A', strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('d M Y - h:i A', strtotime($value));
    }

    /*
    * RELATIONS
    */

    public function Addresses(){
        return $this->hasMany(UserAddress::class, 'user_id', 'id');
    }

}
