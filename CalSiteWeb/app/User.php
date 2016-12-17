<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

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
    public function agendas(){
        return $this->belongsToMany('App\Agenda')
        ->withPivot('add_task',
        'edit_task',
        'delete_task',
        'edit_member',
        'edit_calendar',
        'delete_calendar');

    }

    /**
     *
     */
    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }
}
