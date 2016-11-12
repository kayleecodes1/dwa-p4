<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Project;
use App\Task;

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
            //TODO: 'assignee_id' => , //ensure its a member of the project
            'status' => 'in:To Do,In Progress,Done'
        ]);

        $task = new Task;

        $task->project_id = $project_id;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->assignee_id = $request->input('assignee_id');
        $task->status = $request->input('status');

        $task->save();

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
            //TODO: 'assignee_id' => , //ensure its a member of the project
            'status' => 'in:To Do,In Progress,Done'
        ]);

        $task = Task::find($task_id);

        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->assignee_id = $request->input('assignee_id');
        $task->status = $request->input('status');

        $task->save();

        return Redirect::route('projects.show', ['project_id' => $project_id]);
    }

    public function destroy($project_id, $task_id) {

        //TODO: should check if user is member of project

        Task::destroy($task_id);

        return Redirect::route('projects.show', ['project_id' => $project_id]);
    }
}
