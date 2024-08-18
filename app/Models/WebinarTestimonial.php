<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebinarTestimonial extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/webinar_testimonials/'.$value);
        }
    }
}
