@extends('layouts/default')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
@stop

@section('content')
    {{ $project->title }}
    <h1>Add Team Member</h1>
    <form id="form_create_member" method="POST" action="{{ route('project_members.store', ['project_id' => $project->id]) }}">
        <label>
            <span>User</span>
            <select name="user_id">
                <option>Select a user</option>
                @foreach ($all_users as $user)
                    <option value="{{ $user->id }}"{{ old('user_id') == $user->id ? ' selected="selected"' : ''}}>{{ $user->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('user_id'))
                <span class="error">
                    {{ $errors->first('user_id') }}
                </span>
            @endif
        </label>
        <a href="{{ route('projects.show', ['project_id' => $project->id]) }}">Cancel</a>
        <button class="main" form="form_create_member">Add Team Member</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@stop
