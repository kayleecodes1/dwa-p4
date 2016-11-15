@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/project.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/tasks.css') }}" />
@stop

@section('content')
    @if ($show_projects)
        @foreach (['Your Projects' => $owned_projects, 'Other Projects' => $other_projects] as $heading => $projects)
            <h1>{{ $heading }}</h1>
            @if ($heading == 'Your Projects')
                <div class="project-button-row">
                    <a class="project-button" href="{{ URL::route('projects.create') }}">
                        <i class="fa fa-plus"></i> Create New Project
                    </a>
                </div>
            @endif
            @if (count($projects) == 0)
                <em>No projects to display.</em>
            @else
                <ul class="project-list">
                @foreach ($projects as $project)
                    <li>
                        <a href="{{ URL::route('projects.show', ['project_id' => $project->id]) }}">
                            <i class="fa fa-bookmark"></i> {{ $project->title }}</h3>
                        </a>
                    </li>
                @endforeach
                </ul>
            @endif
        @endforeach
    @else
        //TODO: welcome message
    @endif
@stop
