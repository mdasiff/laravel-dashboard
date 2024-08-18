<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'main_menu_id', 'name', 'type', 'link', 'file', 'status', 'sort', 'level', 'meta_tag_title', 'meta_tag_keywords', 'meta_tag_description'];

    public function children()
    {
        return $this->hasMany(Navigation::class)->orderBy('sort_order','asc');
    }

    public function parent() {
        return $this->belongsTo(Navigation::class);
    }

    public function main_menu() {
        return $this->belongsTo(Navigation::class);
   }
}
