@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}" />
@stop

@section('content')
    <form id="form_register" class="form-login" method="POST" action="{{ route('register.submit') }}">
        <label>
            <span>Name</span>
            <input type="text" name="name" value="{{ old('name') }}" />
            @if ($errors->has('name'))
                <span class="error">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </label>
        <label>
            <span>Email</span>
            <input type="text" name="email" value="{{ old('email') }}" />
            @if ($errors->has('email'))
                <span class="error">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </label>
        <label>
            <span>Password</span>
            <input type="password" name="password" />
            @if ($errors->has('password'))
                <span class="error">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </label>
        <label>
            <span>Confirm Password</span>
            <input type="password" name="password_confirmation" />
        </label>
        <button class="main">Register</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@stop
