@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/tasks.css') }}" />
@stop

@section('content')
    @if (Auth::user())
        - list of projects, and tasks specifically assigned to user
    @else
        - welcome message
    @endif
@stop
