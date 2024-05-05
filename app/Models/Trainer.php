<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;

class Trainer extends Model  implements Authenticatable
{
    use HasFactory ,HasApiTokens ,AuthenticableTrait, Notifiable;

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

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
