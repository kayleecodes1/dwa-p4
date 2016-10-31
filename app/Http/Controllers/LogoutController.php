<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Redirect;

class LogoutController extends BaseController {

    public function submit(Request $request) {

        Auth::logout();

        return Redirect::route('home.index');
    }
}
