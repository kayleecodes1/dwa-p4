<?php

/*namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use View;

use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController {

    public function submit() {

        Auth::logout();
        return Redirect::route('home.index');
    }
}
