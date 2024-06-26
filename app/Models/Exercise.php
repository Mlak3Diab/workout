<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'gif',
        'calories',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
    public function challenges()
    {
        return $this->belongsToMany(Challenge::class);
    }


}
