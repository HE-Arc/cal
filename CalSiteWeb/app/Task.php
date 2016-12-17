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


    // Accessors and mutators
    /**
    * Get the color from calendar depending on priority
    *
    * @param void
    * @return string
    */
    public function getColorAttribute()
    {
        $agenda = $this->agenda()->first();
        switch ($this->priority) {
            case '0':
                $color = "#".$agenda->priority_low_color;
                break;
            case '1':
                $color = "#".$agenda->priority_medium_color;
                break;
            case '2':
                $color = "#".$agenda->priority_high_color;
                break;

            default:
                $color = "#000000";
                break;
        }
        return $color;
    }
}
