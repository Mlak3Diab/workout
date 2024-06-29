<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Muscle extends Model
{
    use HasFactory;
    protected $fillable=['muscle_name'];

    public function getLocalizedNameAttribute()
    {
        $locale = App::getLocale();
        $translations = json_decode(file_get_contents(resource_path("lang/{$locale}/muscle.json")), true);
        return $translations[$this->muscle_name] ?? $this->muscle_name;
    }
}
