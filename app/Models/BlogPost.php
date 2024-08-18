<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['image_alt', 'blog_id', 'heading', 'post', 'image', 'status', 'sort'];

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/blogs/'.$value);
        }
    } 

}
