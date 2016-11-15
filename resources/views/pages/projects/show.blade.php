@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/project.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/tasks.css') }}" />
@stop

@section('content')
    <h1>{{ $project->title }}</h1>
    @if (Auth::user()->id == $project->owner_id)
        <div class="project-button-row">
            <a class="project-button" href="{{ route('projects.edit', ['project_id' => $project->id]) }}">
                <i class="fa fa-pencil"></i> Edit Project
            </a>
            <form id="form_delete_project" method="POST" action="{{ route('projects.destroy', ['project_id' => $project->id]) }}" onsubmit="return confirm('Are you sure you want to delete this project?');">
                {{ method_field('DELETE') }}
                <button class="project-button project-button-secondary" form="form_delete_project">
                    <i class="fa fa-trash"></i> Delete Project
                </button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    @endif
    <p>{{ $project->description }}</p>
    <div class="section-divider"></div>
    <h2>Team Members</h2>
    @if (Auth::user()->id == $project->owner_id)
        <div class="project-button-row">
            <a class="project-button" href="{{ route('project_members.create', ['project_id' => $project->id]) }}">
                 <i class="fa fa-plus"></i> Add Team Member
            </a>
        </div>
    @endif
    <ul class="members-list">
        @foreach ($project->users as $user)
            <li>
                <span>
                    {{ $user->name }}
                </span>
                @if ($user->id == $project->owner_id)
                    <span class="members-list__owner-tag">Owner</span>
                @endif
                @if (Auth::user()->id == $project->owner_id && Auth::user()->id != $user->id)
                    <form id="form_delete_project_member_{{ $user->id }}" method="POST" action="{{ route('project_members.destroy', ['project_id' => $project->id, 'user_id' => $user->id]) }}" onsubmit="return confirm('Are you sure you want to remove this team member?');">
                        {{ method_field('DELETE') }}
                        <button form="form_delete_project_member_{{ $user->id }}">
                            Remove
                        </button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
    <div class="section-divider"></div>
    <h2>All Tasks</h2>
    <div class="project-button-row">
        <a class="project-button" href="{{ route('tasks.create', ['project_id' => $project->id]) }}">
            <i class="fa fa-plus"></i> Add Task
        </a>
    </div>
    @if (count($project->tasks) > 0)
        <table class="tasks-table">
            <tr>
                <th class="tasks-table__status">Status</th>
                <th class="tasks-table__title">Title</th>
                <th class="tasks-table__assignee">Assignee</th>
                <th class="tasks-table__edit">Edit</th>
                <th class="tasks-table__delete">Delete</th>
            </tr>
            @foreach ($project->tasks as $task)
                <tr class="tasks-table__task tasks-table__task--{{ implode('-', explode(' ', strtolower($task->status))) }}">
                    <td class="tasks-table__status">
                        {{ $task->status }}
                    </td>
                    <td class="tasks-table__title">
                        {{ $task->title }}
                    </td>
                    <td class="tasks-table__assignee" title="">
                        {{ !empty($task->assignee) ? $task->assignee->name : '' }}
                    </td>
                    <td class="tasks-table__edit">
                        @if ($task->status != 'Done')
                            <a href="{{ route('tasks.edit', ['project_id' => $project->id, 'task_id' => $task->id]) }}">
                                Edit
                            </a>
                        @endif
                    </td>
                    <td class="tasks-table__delete">
                        @if ($task->status != 'Done')
                            <form id="form_delete_task_{{ $task->id }}" method="POST" action="{{ route('tasks.destroy', ['project_id' => $project->id, 'task_id' => $task->id]) }}" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                {{ method_field('DELETE') }}
                                <button form="form_delete_task_{{ $task->id }}">
                                    Delete
                                </button>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <em>No tasks to display.</em>
    @endif

@stop
