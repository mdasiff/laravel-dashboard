<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/news/'.$value);
        }
    }
    public function getThumbnailAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/news/'.$value);
        }
    }
}
