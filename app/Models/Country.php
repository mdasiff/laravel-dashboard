<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'status'];

    public $timestamps = false;

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/country/'.$value);
        }
    } 
}
