<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class BaseControllerGuarded extends BaseController {

    public function __construct() {

        $this->middleware('auth');
    }
}
