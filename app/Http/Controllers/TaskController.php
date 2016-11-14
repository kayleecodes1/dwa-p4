<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Project;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Redirect;
use View;

class TaskController extends BaseController {

    public function create($project_id) {

        $project = Project::find($project_id);

        return View::make('pages/projects/tasks/create')->with([
            'project' => $project
        ]);
    }

    public function store(Request $request, $project_id) {

        $this->validate($request, [
            'title' => 'required|min:10|max:100',
            'description' => 'required|max:255',
//TODO: check this
            'assignee_id' => [
                'nullable',
                Rule::exists('project_users', 'user_id')->where(function ($query) use (&$project_id) {
                    $query->where('project_id', $project_id);
                })
            ],
            'status' => 'in:To Do,In Progress,Done'
        ]);

        $task = new Task;

        $task->project_id = $project_id;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->assignee_id = !empty($request->input('assignee_id')) ? $request->input('assignee_id') : null;
        $task->status = $request->input('status');

        $task->save();

        Session::flash('flash_message', 'The new task was successfully created.');
        Session::flash('flash_type', 'success');

        return Redirect::route('projects.show', ['project_id' => $project_id]);
    }

    public function edit($project_id, $task_id) {

        //TODO: should check if user is member of project, redirect if not

        //TODO: should check if task is part of the project

        $project = Project::find($project_id);
        $task = Task::find($task_id);

        return View::make('pages/projects/tasks/edit')->with([
            'project' => $project,
            'task' => $task
        ]);
    }

    public function update(Request $request, $project_id, $task_id) {

        //TODO: should check if user is member of project

        //TODO: should check if task is part of the project

        $this->validate($request, [
            'title' => 'required|min:10|max:100',
            'description' => 'required|max:255',
//TODO: check this
            'assignee_id' => [
                'nullable',
                Rule::exists('project_users', 'user_id')->where(function ($query) use (&$project_id) {
                    $query->where('project_id', $project_id);
                })
            ],
            'status' => 'in:To Do,In Progress,Done'
        ]);

        $task = Task::find($task_id);

        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->assignee_id = !empty($request->input('assignee_id')) ? $request->input('assignee_id') : null;
        $task->status = $request->input('status');

        $task->save();

        Session::flash('flash_message', 'The task was successfully updated.');
        Session::flash('flash_type', 'success');

        return Redirect::route('projects.show', ['project_id' => $project_id]);
    }

    public function destroy($project_id, $task_id) {

        //TODO: should check if user is member of project

        Task::destroy($task_id);

        Session::flash('flash_message', 'The task was successfully deleted.');
        Session::flash('flash_type', 'success');

        return Redirect::route('projects.show', ['project_id' => $project_id]);
    }
}
