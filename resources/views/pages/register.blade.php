@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}" />
@stop

@section('content')
    <form id="form_register" class="form_login" method="POST">
        @if (count($errors) > 0)
            <ul class="errors">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <label>
            <span>Name</span>
            <input type="text" name="name" value="{{ old('name') }}" />
        </label>
        <label>
            <span>Email</span>
            <input type="text" name="email" value="{{ old('email') }}" />
        </label>
        <label>
            <span>Password</span>
            <input type="password" name="password" />
        </label>
        <label>
            <span>Confirm Password</span>
            <input type="password" name="password_confirmation" />
        </label>
        <button class="main">Register</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@stop
