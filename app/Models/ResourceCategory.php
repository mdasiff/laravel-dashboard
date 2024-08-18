<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/resource/'.$value);
        }
    }

    public function active_resources()
    {
        return $this->hasMany(Resource::class)->where('status',1)->orderBy('sort');
    }
}
