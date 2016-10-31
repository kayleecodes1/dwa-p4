<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use View;

use Illuminate\Support\Facades\Auth;

class BaseController extends Controller {

    public function __construct() {

        //$this->middleware('auth');
    }
}
