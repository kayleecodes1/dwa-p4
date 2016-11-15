@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/resource.css') }}" />
@stop

@section('content')
    <h1>{{ $project->title }}</h1>
    <h2>Add Task</h2>
    <form id="form_create_task" class="form-resource" method="POST" action="{{ route('tasks.store', ['project_id' => $project->id]) }}">
        <label>
            <span>Title</span>
            <input class="extra-large" type="text" name="title" value="{{ old('title') }}" />
            @if ($errors->has('title'))
                <span class="error">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </label>
        <label>
            <span>Description</span>
            <textarea class="extra-large" name="description">{{ old('description') }}</textarea>
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
        <div class="form-resource__button-row">
            <a href="{{ route('projects.show', ['project_id' => $project->id]) }}">Cancel</a>
            <button class="main" form="form_create_task">Add Task</button>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@stop
