@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}" />
@stop

@section('content')
    <form id="form_login" class="form-login" method="POST" action="{{ route('login.submit') }}">
        @if ($errors->has('auth'))
            <span class="error">
                {{ $errors->first('auth') }}
            </span>
        @endif
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
            <span>Remember me</span>
            <input type="checkbox" name="remember" value="true" {{ old('remember') ? 'checked' : '' }} />
        </label>
        <button class="main">Login</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@stop
