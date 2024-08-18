<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'image', 'message', 'status', 'sort', 'type', 'video', 'show_on_home_page', 'image_alt'];

    public function scopeFront($query)
    {
        return $query->where('status',1)->orderBy('sort');
    }
    public function scopeHome($query)
    {
        return $query->where('show_on_home_page',1)->orderBy('sort');
    }

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/testimonials/'.$value);
        }
    }
}
