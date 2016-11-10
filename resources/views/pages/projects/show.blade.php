@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/tasks.css') }}" />
@stop

@section('content')
    @if (Auth::user()->id == $project->owner_id)
        <a href="{{ route('projects.edit', ['project_id' => $project->id]) }}">Edit Project</a>
        <form id="form_delete_project" method="POST" action="{{ route('projects.destroy', ['project_id' => $project->id]) }}">
            {{ method_field('DELETE') }}
            <button form="form_delete_project">Delete Project</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    @endif
    <h1>{{ $project->title }}</h1>
    <p>{{ $project->description }}</p>
    <h2>Team Members</h2>
    <a href="{{ route('project_members.create', ['project_id' => $project->id]) }}">Add Team Member</a>
    <ul>
        @foreach ($project->users as $user)
            <li>{{ $user->name }}{{ $user->id == $project->owner_id ? ' (Owner)' : '' }}</li>
        @endforeach
    </ul>
    <h2>All Tasks</h2>
    @include('includes/task_list', ['tasks' => $project->tasks])
@stop
