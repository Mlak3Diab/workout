<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trainer extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'email',
        'password',
        'cv',
        ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
