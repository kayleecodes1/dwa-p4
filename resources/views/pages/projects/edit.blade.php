@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
@stop

@section('content')
    <h1>Edit Project</h1>
    <form id="form_edit_project" method="POST" action="{{ route('projects.update', ['project_id' => $project->id]) }}">
        {{ method_field('PUT') }}
        <label>
            <span>Title</span>
            <input type="text" name="title" value="{{ old('title', $project->title) }}" />
            @if ($errors->has('title'))
                <span class="error">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </label>
        <label>
            <span>Description</span>
            <textarea name="description">{{ old('description', $project->description) }}</textarea>
            @if ($errors->has('description'))
                <span class="error">
                    {{ $errors->first('description') }}
                </span>
            @endif
        </label>
        <a href="{{ route('projects.show', ['project_id' => $project->id]) }}">Cancel</a>
        <button class="main" form="form_edit_project">Update Project</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@stop
