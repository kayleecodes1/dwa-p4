<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use View;

use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController {

    public function __construct() {
        $this->has_errors = false;
        $this->error_message = '';
    }

    public function index() {
        return View::make('pages/login', array(
            'has_errors' => $this->has_errors,
            'error_message' => $this->error_message
        ));
    }

    public function submit() {
        do {
            // Validate username field.
            $username = '';
            if (!isset($_POST['user']) || ($username = trim($_POST['user'])) == '') {
                $this->has_errors = true;
                $this->error_message = 'Please enter a valid username and password.';
                break;
            }
            // Validate password field.
            $password = '';
            if (!isset($_POST['pass']) || ($password = trim($_POST['pass'])) == '') {
                $this->has_errors = true;
                $this->error_message = 'Please enter a valid username and password.';
                break;
            }
            // Get remember me field.
            $remember = isset($_POST['remember']) && $_POST['remember'] == 'true';
            // Validate login credentials.
            if (Auth::attempt(['email' => $username, 'password' => $password], $remember)) {
                //TODO
            }
        } while (0);

        return $this->index();
    }
}

//Auth::logout();
