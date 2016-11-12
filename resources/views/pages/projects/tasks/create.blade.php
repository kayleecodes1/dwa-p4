@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
@stop

@section('content')
    {{ $project->title }}
    <h1>Add Task</h1>
    <form id="form_create_task" method="POST" action="{{ route('tasks.store', ['project_id' => $project->id]) }}">
        <label>
            <span>Title</span>
            <input type="text" name="title" value="{{ old('title') }}" />
            @if ($errors->has('title'))
                <span class="error">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </label>
        <label>
            <span>Description</span>
            <textarea name="description">{{ old('description') }}</textarea>
            @if ($errors->has('description'))
                <span class="error">
                    {{ $errors->first('description') }}
                </span>
            @endif
        </label>
        <label>
            <span>Assignee</span>
            <select name="assignee_id">
                <option value=""></option>
                @foreach ($project->users as $user)
                    <option value="{{ $user->id }}"{{ old('assignee_id') == $user->id ? ' selected="selected"' : ''}}>{{ $user->name }}</option>
                @endforeach
            </select>
        </label>
        <label>
            <span>Status</span>
            <select name="status">
                @foreach (['To Do', 'In Progress', 'Done'] as $status)
                    <option value="{{ $status }}"{{ old('status') == $status ? ' selected="selected"' : ''}}>{{ $status }}</option>
                @endforeach
            </select>
            @if ($errors->has('status'))
                <span class="error">
                    {{ $errors->first('status') }}
                </span>
            @endif
        </label>
        <a href="{{ route('projects.show', ['project_id' => $project->id]) }}">Cancel</a>
        <button class="main" form="form_create_task">Add Task</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@stop
