<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    public $timestamps = false;

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
        return $this->hasMany('App\Task');
    }

    public function users(){
        return $this->belongsToMany('App\User')
        ->withPivot('add_task',
        'edit_task',
        'delete_task',
        'add_member',
        'remove_member',
        'edit_calendar',
        'delete_calendar');

    }

    // Accessors and mutators -----------------------------------------------
    public function setPriorityLowColorAttribute($value){
        $this->attributes['priority_low_color'] = substr($value, 1);
    }

    public function setPriorityMediumColorAttribute($value){
        $this->attributes['priority_medium_color'] = substr($value, 1);
    }

    public function setPriorityHighColorAttribute($value){
        $this->attributes['priority_high_color'] = substr($value, 1);
    }
}
