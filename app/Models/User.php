<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'address',
        'phone',
        'avatar',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'user_subject')->withPivot('created_at', 'updated_at', 'status', 'process')->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_course')->withPivot('status', 'created_at', 'updated_at', 'process')->withTimestamps();
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'user_task')->withPivot('report', 'status', 'created_at', 'updated_at')->withTimestamps();
    }
}
