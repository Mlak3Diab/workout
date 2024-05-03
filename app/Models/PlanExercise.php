<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanExercise extends Model
{
    use HasFactory;
    protected $fillable=[
        'nmber_of_week',
        'time',
        'repetition'
    ];
}
