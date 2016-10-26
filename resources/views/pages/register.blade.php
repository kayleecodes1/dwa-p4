@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/register.css') }}" />
@stop

@section('content')
    <form id="form_register" method="POST">
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
            Confirm Password
            <input type="text" name="pass_confirm" />
        </label>
        <button class="main">Login</button>
    </form>
@stop
