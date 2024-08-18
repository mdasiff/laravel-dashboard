<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function setTitleAttribute($name){
        $this->title = $title;
        $this->attributes['slug'] = ucWords(str_slug($this->name , ""));
    }

    public function industry_category()
    {
        return $this->belongsTo(IndustryCategory::class);
    }

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/industry/'.$value);
        }
    }

    public function getFileAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/industry/'.$value);
        }
    } 
}
