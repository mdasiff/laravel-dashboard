<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSearch extends Model
{
    use HasFactory;

    protected $table = 'global_search';
    public $timestamps = false;
}
