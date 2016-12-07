<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alias', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function calendars(){
        return $this->belongsToMany('Calendar')
        ->withPivot('add_task',
        'edit_task',
        'delete_task',
        'add_member',
        'remove_member',
        'edit_calendar',
        'delete_calendar');

    }
}
