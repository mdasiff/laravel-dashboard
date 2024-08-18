<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['image_alt', 'blog_category_id', 'title', 'sub_title', 'image', 'slug', 'highlight_keywords', 'status', 'meta_tag_title', 'meta_tag_description', 'views', 'listing_page_description'];

    public function scopeFront($query, $request)
    {
        if ($request->filled('k')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'LIKE', '%'.$request->k.'%')
                  ->orWhere('sub_title', 'LIKE', '%'.$request->k.'%')
                  ->orWhere('highlight_keywords', 'LIKE', '%'.$request->k.'%')
                  ->orWhere('meta_tag_title', 'LIKE', '%'.$request->k.'%')
                  ->orWhere('meta_tag_description', 'LIKE', '%'.$request->k.'%');
            });
        }

        if ($request->filled('bc')) {
            $bc = BlogCategory::where('slug', $request->bc)->first();

            if($bc) {
                $query->where('blog_category_id', $bc->id);
            }
        }

        return $query->where('status', 1)->latest();
    }

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/blogs/'.$value);
        }
        return asset('front/assets/images/blog/the-future-of-ai.jpg');
    }

    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function posts()
    {
        return $this->hasMany(BlogPost::class)->where('status',1)->orderBy('sort');
    }
}
