<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    public function owner() {
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'project_users');;
    }

    public function tasks() {
        return $this->hasMany('App\Task');
    }

    public function userTasks() {
        return $this->hasMany('App\Task');
    }
}
