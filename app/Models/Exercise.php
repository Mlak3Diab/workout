<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'gif',
        'calories',
    ];

    public function getLocalizedNameAttribute()
    {
        $locale = App::getLocale();
        $translations = json_decode(file_get_contents(resource_path("lang/{$locale}/exercise_name.json")), true);
        return $translations[$this->name] ?? $this->name;
    }
    public function getLocalizedDescriptionAttribute()
    {
        $locale = App::getLocale();
        $translations = json_decode(file_get_contents(resource_path("lang/{$locale}/exercise_description.json")), true);
        return $translations[$this->name] ?? $this->name;
    }

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
