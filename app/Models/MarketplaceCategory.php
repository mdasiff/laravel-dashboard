<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/marketplace/'.$value);
        }
    }

    // public function active_solutions()
    // {
    //     return $this->hasMany(Solution::class)->where('status',1)->orderBy('sort');
    // }
}
