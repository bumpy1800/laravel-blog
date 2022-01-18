<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User2 extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    protected $table = 'user2';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
