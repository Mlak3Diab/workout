<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable=[
       'number_of_week'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
