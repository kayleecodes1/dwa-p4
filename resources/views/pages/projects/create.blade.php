@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
@stop

@section('content')
    <h1>Create New Project</h1>
    <form id="form_create_project" method="POST" action="{{ route('projects.store') }}">
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
        <a href="{{ route('home.index') }}">Cancel</a>
        <button class="main" form="form_create_project">Create New Project</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@stop
