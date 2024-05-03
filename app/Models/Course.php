<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'total_time',
        'total_calories',
        'muscle',

    ];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class);
    }




}
