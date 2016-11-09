<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use View;

use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController {

    public function index() {

        $view = View::make('pages/home');

        if ($user = Auth::user()) {
            $view = $view->with([
                'show_projects' => true,
                'owned_projects' => $user->owned_projects,
                'other_projects' => $user->other_projects
            ]);
        }

        return $view;
    }
}
