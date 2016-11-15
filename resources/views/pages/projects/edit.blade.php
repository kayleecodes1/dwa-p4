@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/resource.css') }}" />
@stop

@section('content')
    <h1>{{ $project->title }}</h1>
    <h2>Edit Project</h2>
    <form id="form_edit_project" class="form-resource" method="POST" action="{{ route('projects.update', ['project_id' => $project->id]) }}">
        {{ method_field('PUT') }}
        <label>
            <span>Title</span>
            <input class="extra-large" type="text" name="title" value="{{ old('title', $project->title) }}" />
            @if ($errors->has('title'))
                <span class="error">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </label>
        <label>
            <span>Description</span>
            <textarea class="extra-large" name="description">{{ old('description', $project->description) }}</textarea>
            @if ($errors->has('description'))
                <span class="error">
                    {{ $errors->first('description') }}
                </span>
            @endif
        </label>
        <div class="form-resource__button-row">
            <a href="{{ route('projects.show', ['project_id' => $project->id]) }}">Cancel</a>
            <button class="main" form="form_edit_project">Update Project</button>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@stop
