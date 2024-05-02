<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;

class Trainer extends Model  implements Authenticatable , MustVerifyEmail
{
    use HasFactory ,HasApiTokens ,AuthenticableTrait, Notifiable;
    public function hasVerifiedEmail(){
        return $this->email_verified_at !== null;
    }
    public function markEmailAsVerified(){

        $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }
    public function sendEmailVerificationNotification(){
        $this->notify(new \Illuminate\Auth\Notifications\VerifyEmail);
    }
    public function getEmailForVerification(){
        return $this->email;
    }


    protected $fillable = [
        'username',
        'email',
        'password',
        'cv',
        'image',
      'email_verified_at',

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
