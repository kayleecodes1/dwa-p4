<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use View;

class HomeController extends BaseController {

    public function index() {
        return View::make('pages/home');
    }
}
