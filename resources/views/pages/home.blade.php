@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/tasks.css') }}" />
@stop

@section('content')
    @if (Auth::user())
        <h1>Your Tasks</h1>
        @foreach (Auth::user()->projects as $project)
            <h2>{{ $project->title }}</h2>
            <ul>
                @foreach ($project->tasks->where('assignee_id', Auth::user()->id) as $task)
                    <li>{{ $task->title }}</li>
                @endforeach
            </ul>
        @endforeach
    @else
        - welcome message
    @endif
@stop
