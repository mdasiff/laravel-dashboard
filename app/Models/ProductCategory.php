<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

   

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/product/'.$value);
        }
    }

    public function active_products()
    {
        return $this->hasMany(Product::class)->where('status',1)->orderBy('sort');
    }
}
