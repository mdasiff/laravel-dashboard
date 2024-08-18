<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WebinarQuery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }
}
