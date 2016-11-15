@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/resource.css') }}" />
@stop

@section('content')
    <h2>Create New Project</h2>
    <form id="form_create_project" class="form-resource" method="POST" action="{{ route('projects.store') }}">
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
        <div class="form-resource__button-row">
            <a href="{{ route('home.index') }}">Cancel</a>
            <button class="main" form="form_create_project">Create New Project</button>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@stop
