<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/banners/'.$value);
        }
        else{
            //return asset('images/dummy-user.png');
        }
    }
    public function getImageMobileAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/banners/'.$value);
        }
        else{
            //return asset('images/dummy-user.png');
        }
    } 
    public function scopeActive($query) {
        return $query->where('status', '=', 1)->orderBy('sort')->limit(8);
    }
}
