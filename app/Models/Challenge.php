<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'level',
        'total_time',
        'total_calories',
        'muscle',

    ];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class);
    }

    public function Trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }


}
