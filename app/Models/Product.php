<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/product/'.$value);
        }
    }

    public function scopeFooter($value, $name)
    {
        return $value->where('name', 'LIKE', '%'.$name.'%')->where('status',1)->orderBy('sort');
    }
}
