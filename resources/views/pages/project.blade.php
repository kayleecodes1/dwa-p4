@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/tasks.css') }}" />
@stop

@section('content')
    <a>Edit Project</a>
    <a>Delete Project</a>
    <h1>{{ $project->title }}</h1>
    <p>{{ $project->description }}</p>
    <h2>Team Members</h2>
    <ul>
        @foreach ($project->users as $user)
            <li>{{ $user->name }}{{ $user->id == $project->owner_id ? ' (Owner)' : '' }}</li>
        @endforeach
    </ul>
    <h2>All Tasks</h2>
    @include('includes/task_list', ['tasks' => $project->tasks])
@stop
