<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps = false;

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
        'agenda_id',
    ];

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function agenda() {
        return $this->belongsTo('App\Agenda');
    }
}
