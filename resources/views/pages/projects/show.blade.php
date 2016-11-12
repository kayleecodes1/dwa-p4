@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/tasks.css') }}" />
@stop

@section('content')
    <h1>{{ $project->title }}</h1>
    @if (Auth::user()->id == $project->owner_id)
        <a href="{{ route('projects.edit', ['project_id' => $project->id]) }}">Edit Project</a>
        <form id="form_delete_project" method="POST" action="{{ route('projects.destroy', ['project_id' => $project->id]) }}">
            {{ method_field('DELETE') }}
            <button form="form_delete_project">Delete Project</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    @endif
    <p>{{ $project->description }}</p>
    <h2>Team Members</h2>
    <a href="{{ route('project_members.create', ['project_id' => $project->id]) }}">Add Team Member</a>
    <ul>
        @foreach ($project->users as $user)
            <li>{{ $user->name }}{{ $user->id == $project->owner_id ? ' (Owner)' : '' }}</li>
            @if (Auth::user()->id == $project->owner_id && Auth::user()->id != $user->id)
                <form id="form_delete_project_member_{{ $user->id }}" method="POST" action="{{ route('project_members.destroy', ['project_id' => $project->id, 'user_id' => $user->id]) }}">
                    {{ method_field('DELETE') }}
                    <button form="form_delete_project_member_{{ $user->id }}">Remove Member</button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            @endif
        @endforeach
    </ul>
    <h2>All Tasks</h2>
    <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}">Add Task</a>
    <ul>
        @if (count($project->tasks) > 0)
            @foreach ($project->tasks as $task)
                <li>
                    {{ $task->title }}
                    {{ $task->status }}
                    <a href="{{ route('tasks.edit', ['project_id' => $project->id, 'task_id' => $task->id]) }}">Edit Task</a>
                    <form id="form_delete_task_{{ $task->id }}" method="POST" action="{{ route('tasks.destroy', ['project_id' => $project->id, 'task_id' => $task->id]) }}">
                        {{ method_field('DELETE') }}
                        <button form="form_delete_task_{{ $task->id }}">Delete Task</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </li>
            @endforeach
        @else
            No tasks.
        @endif
    </ul>

@stop
