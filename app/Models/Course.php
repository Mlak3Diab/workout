<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'level',
        'total_time',
        'kcal',
        'muscle',

    ];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class);
    }


}
