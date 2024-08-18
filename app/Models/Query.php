<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;

    protected $fillable = ['fname', 'lname', 'phone', 'email', 'job_title', 'comapany', 'country', 'message'];
}
