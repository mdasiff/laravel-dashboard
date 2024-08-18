<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function service_category()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/solution/'.$value);
        }
    }

    public function getFileAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/solution/'.$value);
        }
    } 
}

