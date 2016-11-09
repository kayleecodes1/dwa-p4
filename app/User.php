<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function owned_projects() {
        return $this->hasMany('App\Project', 'owner_id')
            ->orderBy('title', 'asc');
    }

    public function other_projects() {
        return $this->projects()->where('owner_id', '!=', $this->id);
    }

    public function projects() {
        return $this->belongsToMany('App\Project', 'project_users')
            ->orderBy('title', 'asc');
    }

    public function tasks() {
        return $this->hasMany('App\Task', 'assignee_id')
            ->orderBy('title', 'asc');
    }
}
