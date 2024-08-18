<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSpeak extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'employee_speaks';

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return asset('uploads/employee-speaks/'.$value);
        }
    }
}
