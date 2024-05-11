<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
      'image',
      'price',
      'name'
    ];
    public function trainers(){
        return $this->belongsTo(Trainer::class);
    }
}
