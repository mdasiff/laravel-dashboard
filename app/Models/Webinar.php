<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Webinar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'webinar_date' => 'datetime',
    ];

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }

    public function scopeUpcomming($query)
    {
        return $query->where('status', '=', 1)->where('webinar_date', '>', now());
    }
    public function scopePast($query)
    {
        return $query->where('webinar_date', '<', now());
    }

    public function scopeInactive($query)
    {
        $now = Carbon::now();
        $date = Carbon::parse($now)->toDateString();
        return $query->where('status', '=', 0)->whereDate('webinar_date', '>=', $date);
    }

    public function scopeFrontSingle($query)
    {
        return $query->where('status',1)
                ->where('webinar_date', '>', Carbon::now())
                ->orderBy('webinar_date', 'asc');
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }

    public function webinar_queries()
    {
        return $this->hasMany(WebinarQuery::class);
    }
}
