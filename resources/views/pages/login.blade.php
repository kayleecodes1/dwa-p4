@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}" />
@stop

@section('content')
    <form id="form_login" class="form_login" method="POST">
        @if (count($errors) > 0)
            <ul class="errors">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <label>
            <span>Email</span>
            <input type="text" name="email" value="{{ old('email') }}" />
        </label>
        <label>
            <span>Password</span>
            <input type="password" name="password" />
        </label>
        <label>
            <span>Remember me</span>
            <input type="checkbox" name="remember" value="true" {{ old('remember') ? 'checked' : '' }} />
        </label>
        <button class="main">Login</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@stop
