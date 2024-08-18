<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerQuery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getFileAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/career_resume/'.$value);
        }
    }
}
