<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    protected $fillable = [
        'title',
        'time_start',
        'time_end',
        'description',
        'priority',
        'location',
        'attachment_url',
        'calendar_id',
    ];

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function calendar() {
        return $this->belongsTo('Calendar');
    }
}
