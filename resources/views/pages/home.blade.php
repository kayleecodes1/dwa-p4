@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/tasks.css') }}" />
@stop

@section('content')
    @if ($show_projects)
        <h1>Tasks Assigned to You</h1>
        @foreach (['Your Projects' => $owned_projects, 'Other Projects' => $other_projects] as $heading => $projects)
            @if ($heading == 'Your Projects')
                <a href="{{ URL::route('projects.create') }}">Create New Project</a>
            @endif
            <h2>{{ $heading }}</h2>
            @if (count($projects) == 0)
                No projects to display
            @endif
            @foreach ($projects as $project)
                <a href="{{ URL::route('projects.show', ['project_id' => $project->id]) }}">
                    <h3>{{ $project->title }}</h3>
                </a>
                <ul>
                    @if (count($project->user_tasks) > 0)
                        @foreach ($project->user_tasks as $task)
                            <li>
                                {{ $task->title }}
                                {{ $task->status }}
                            </li>
                        @endforeach
                    @else
                        No tasks.
                    @endif
                </ul>

            @endforeach
        @endforeach
    @else
        //TODO: welcome message
    @endif
@stop
