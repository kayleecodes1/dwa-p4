<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Redirect;
use View;

class ProjectController extends BaseController {

    public function show($project_id) {

        $project = Project::find($project_id);

        return View::make('pages/projects/show')->with([
            'project' => $project
        ]);
    }

    public function create() {

        return View::make('pages/projects/create');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required|min:10|max:100',
            'description' => 'required|max:255'
        ]);

        $project = new Project;
        $user = Auth::user();

        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->owner_id = $user->id;

        $project->save();

        DB::table('project_users')->insert([
            'project_id' => $project->id,
            'user_id' => $user->id
        ]);

        Session::flash('flash_message', 'The new project was successfully created.');
        Session::flash('flash_type', 'success');

        return Redirect::route('projects.show', ['project_id' => $project->id]);
    }

    public function edit($project_id) {

        //TODO: should check if user is owner, redirect if not

        $project = Project::find($project_id);

        return View::make('pages/projects/edit')->with([
            'project' => $project
        ]);
    }

    public function update(Request $request, $project_id) {

        //TODO: should check if user is owner

        $this->validate($request, [
            'title' => 'required|min:10|max:100',
            'description' => 'required|max:255'
        ]);

        $project = Project::find($project_id);

        $project->title = $request->input('title');
        $project->description = $request->input('description');

        $project->save();

        Session::flash('flash_message', 'The project was successfully updated.');
        Session::flash('flash_type', 'success');

        return Redirect::route('projects.show', ['project_id' => $project_id]);
    }

    public function destroy($project_id) {

        //TODO: should check if user is owner

        Project::destroy($project_id);

        Session::flash('flash_message', 'The project was successfully deleted.');
        Session::flash('flash_type', 'success');

        return Redirect::route('home.index');
    }
}
