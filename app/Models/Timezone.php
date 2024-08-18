<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    use HasFactory;

    protected $fillable = ['country_code', 'country_name', 'time_zone', 'gmt_offset'];
}
