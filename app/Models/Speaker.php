<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function webinars()
    {
        return $this->hasMany(Webinar::class);
    }

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/speaker/'.$value);
        }
        else{
            return asset('images/dummy-user.png');
        }
    } 
}
