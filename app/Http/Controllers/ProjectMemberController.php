<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Project;

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

        return Redirect::route('projects.show', ['project_id' => $project_id]);
    }
}
