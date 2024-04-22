<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
//use Illuminate\Auth\MustVerifyEmail;
class Trainer extends Model  implements Authenticatable , MustVerifyEmail
{
    use HasFactory ,HasApiTokens ,AuthenticableTrait;
    public function hasVerifiedEmail(){}
    public function markEmailAsVerified(){}
    public function sendEmailVerificationNotification(){}
    public function getEmailForVerification(){}


    protected $fillable = [
        'username',
        'email',
        'password',
        'cv',
        'image',
        ];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [

        'email_verified_at' => 'datetime',

    ];
}
