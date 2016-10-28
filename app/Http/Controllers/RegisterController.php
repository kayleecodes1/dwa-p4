<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\MessageBag;

class RegisterController extends BaseController {

    public function index() {
        return View::make('pages/register');
    }

    public function submit(Request $request) {

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $request->merge(['password' => Hash::make($request->password)]);
        $user = User::create($request->all());

        return Redirect::route('register.index')
            ->withInput($request->except(['password', 'password_confirmation']));
    }
}
