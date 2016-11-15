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
        <h1>Welcome to TaskMaster!</h1>
        <p><strong>TaskMaster</strong> is a web application for managing projects and tracking tasks associated with those projects. The basic functionality of the application is to create teams of users, create projects with team members, create tasks associated with projects, and assign users on a team to those tasks.</p>
        <p><em>To start tracking tasks, please login or register using the links above.</em></p>
    @endif
@stop
