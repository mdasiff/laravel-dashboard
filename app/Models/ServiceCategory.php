<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/service/'.$value);
        }
    }

    public function active_services()
    {
        return $this->hasMany(Service::class)->where('status',1)->orderBy('sort');
    }
}
