<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use View;

class HomeController extends BaseController {

    public function index() {

        $view = View::make('pages/home');

        // If the user is authenticated, .
        if (Auth::user()) {
            //TODO
            $projects = array();
            $view = $view->with('projects', $projects);
        }
        // If the user is not authenticated.
        else {

        }

        return $view;
    }
}
