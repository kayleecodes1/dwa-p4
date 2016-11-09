<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Project extends Model {

    public function owner() {
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'project_users')
            ->orderByRaw('CASE WHEN id = ' . $this->owner_id . ' THEN 1 ELSE 2 END')
            ->orderBy('name', 'asc');
    }

    public function tasks() {
        return $this->hasMany('App\Task')
            ->orderByRaw('FIELD(status, "To Do", "In Progress", "Done")')
            ->orderBy('title', 'asc');
    }

    public function user_tasks() {
        return $this->tasks()
            ->where('assignee_id', Auth::user()->id);
    }
}
