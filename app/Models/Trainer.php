<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
class Trainer extends Model implements Authenticatable
{
    use HasFactory ,HasApiTokens ,AuthenticableTrait;
    protected $fillable = [
        'username',
        'email',
        'password',
        'cv',
        'image',
        ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [

        'email_verified_at' => 'datetime',

    ];
}
