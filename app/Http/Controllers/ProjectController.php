<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use View;

use App\Project;

class ProjectController extends BaseController {

    public function index($project_id) {

        $view = View::make('pages/project')->with([
            'project' => Project::find($project_id)
        ]);

        return $view;
    }
}
