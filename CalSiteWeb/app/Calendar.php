<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    protected $fillable = [
        'title',
        'priority_low_color',
        'priority_medium_color',
        'priority_high_color',
    ];

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function tasks(){
        return $this->hasMany('Task');
    }

    public function users(){
        return $this->belongsToMany('User')
        ->withPivot('add_task',
        'edit_task',
        'delete_task',
        'add_member',
        'remove_member',
        'edit_calendar',
        'delete_calendar');

    }
}
