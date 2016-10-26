@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}" />
@stop

@section('content')
    <form id="form_login" method="POST">
        <?php if ($has_errors): ?>
        <div class="error">
            {{ $error_message }}
        </div>
        <?php endif; ?>
        <label>
            Username
            <input type="text" name="user" />
        <label>
        <label>
            Password
            <input type="text" name="pass" />
        </label>
        <label>
            Remember me
            <input type="checkbox" name="remember" value="true" />
        </label>
        <button class="main">Login</button>
    </form>
@stop
