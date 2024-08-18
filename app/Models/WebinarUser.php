<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebinarUser extends Model
{
    use HasFactory;

    protected $fillable = ['webinar_id', 'fname', 'lname', 'phone', 'email', 'job_title', 'comapany', 'country', 'message'];

    public function webinar() {
        return $this->belongsTo(Webinar::class);
    }
}
