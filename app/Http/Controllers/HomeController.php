<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use View;

use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController {

    public function index() {

        $view = View::make('pages/home');
//TODO: is this the wrong Auth ?
        // If the user is authenticated, //TODO.
        if ($user = Auth::user()) {
            $view = $view->with('projects', array(
                'projects' => $user->projects
            ));
        }
        // If the user is not authenticated.
        else {

        }

        return $view;
    }
}
