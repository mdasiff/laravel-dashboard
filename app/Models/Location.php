<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'address_1', 'address_2', 'city', 'country_id', 'zip', 'phone', 'fax', 'email', 'cin', 'status'];
}
