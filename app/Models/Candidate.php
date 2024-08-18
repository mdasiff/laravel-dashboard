<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillabele = ['position_id', 'name', 'email', 'phone', 'total_experience', 'dob', 'location', 'resume'];

    public function position() {
        return $this->belongsTo(Position::class);
    }
}
