<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'status', 'sort'];

    public function scopeFront($query)
    {
        return $query->where('status',1)->orderBy('sort');
    }
}
