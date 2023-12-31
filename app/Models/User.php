<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "accounts";

    protected $fillable = ['full_name', 'phone_number', 'email', 'avatar', 'username', 'password', 'province_id', 'district_id', 'ward_id', 'address', 'role', 'status', 'google_id', 'verification_token', 'last_email_sent_at'];

    protected $hidden = ['password', 'verification_token', 'last_email_sent_at'];

    protected $casts = [
        'last_email_sent_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
}
