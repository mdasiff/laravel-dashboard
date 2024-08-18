<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/industry/'.$value);
        }
    }

    public function active_industries()
    {
        return $this->hasMany(Industry::class)->where('status',1)->orderBy('sort');
    }
}
