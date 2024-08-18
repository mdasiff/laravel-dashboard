<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function resource_category()
    {
        return $this->belongsTo(ResourceCategory::class);
    }

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/resource/'.$value);
        }
    }
    public function getHomeImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/resource/'.$value);
        }
    }
    public function getRawFileAttribute()
    {
        return $this->attributes['file'];
    }
    public function getFileAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/resource/'.$value);
        }
    }
    
    public function resource_queries()
    {
        return $this->hasMany(ResourceQuery::class);
    }
}
