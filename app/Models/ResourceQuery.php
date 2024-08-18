<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceQuery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
