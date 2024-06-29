<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

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

    public function getLocalizedNameAttribute()
    {
        $locale = App::getLocale();
        $translations = json_decode(file_get_contents(resource_path("lang/{$locale}/course_name.json")), true);
        return $translations[$this->name] ?? $this->name;
    }

    public function getLocalizedLevelAttribute()
    {
        $locale = App::getLocale();
        $translations = json_decode(file_get_contents(resource_path("lang/{$locale}/course_level.json")), true);
        return $translations[$this->level] ?? $this->level;
    }

    public function getLocalizedMuscleAttribute()
    {
        $locale = App::getLocale();
        $translations = json_decode(file_get_contents(resource_path("lang/{$locale}/course_muscle.json")), true);
        return $translations[$this->muscle] ?? $this->muscle;
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class);
    }




}
