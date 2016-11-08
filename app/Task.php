<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    public function project() {
        return $this->belongsTo('App\Project');
    }

    public function assignee() {
        return $this->belongsTo('App\User', 'assignee_id');
    }
}
