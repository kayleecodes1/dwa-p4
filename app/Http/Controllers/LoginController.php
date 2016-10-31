<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\MessageBag;

class LoginController extends BaseController {

    public function index() {
        return View::make('pages/login');
    }

    public function submit(Request $request) {

        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
            'remember' => ''
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember') == 'true';

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            return Redirect::route('home.index');
        }

        return Redirect::route('login.index')
            ->withInput($request->except('password'))
            ->with([
                'errors' => new MessageBag(['auth' => 'The username and password are incorrect.'])
            ]);
    }
}
