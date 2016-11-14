<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Redirect;
use View;

class ProjectMemberController extends BaseController {

    public function create($project_id) {

        //TODO: ensure project_id exists

        //TODO: should check if user is owner

        $project = Project::find($project_id);

        $all_users = DB::table('users')
            ->whereNotIn('id', function($query) use (&$project_id) {
                $query->select('user_id')
                    ->from('project_users')
                    ->where('project_id', $project_id);
            })
            ->get();

        return View::make('pages/projects/members/create')
            ->with([
                'project' => $project,
                'all_users' => $all_users
            ]);
    }

    public function store(Request $request, $project_id) {

        //TODO: ensure project_id exists

        //TODO: should check if user is owner

        $this->validate($request, [
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('project_users')->where(function ($query) use (&$project_id) {
                    $query->where('project_id', $project_id);
                })
            ]
        ]);

        $user_id = $request->input('user_id');

        DB::table('project_users')->insert([
            'project_id' => $project_id,
            'user_id' => $user_id
        ]);

        Session::flash('flash_message', 'The team member was successfully added.');
        Session::flash('flash_type', 'success');

        return Redirect::route('projects.show', ['project_id' => $project_id]);
    }

    public function destroy($project_id, $user_id) {

        //TODO: ensure project_id exists

        //TODO: should check if user is owner
        //TODO: dont let them remove themselves if the owner

        DB::table('project_users')
            ->where([
                ['project_id', $project_id],
                ['user_id', $user_id]
            ])
            ->delete();

        Session::flash('flash_message', 'The team member was successfully removed.');
        Session::flash('flash_type', 'success');

        return Redirect::route('projects.show', ['project_id' => $project_id]);
    }
}
