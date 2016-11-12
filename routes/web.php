<?php

Auth::routes();

// Homepage
Route::get('/', [
    'as' => 'home.index',
    'uses' => 'HomeController@index'
]);


/*
 * User Registration / Login
 */

// Show form to register.
Route::get('/register', [
    'as' => 'register.index',
    'uses' => 'RegisterController@index'
]);

// Process form to register.
Route::post('/register', [
    'as' => 'register.submit',
    'uses' => 'RegisterController@submit'
]);

// Show form to login.
Route::get('/login', [
    'as' => 'login.index',
    'uses' => 'LoginController@index'
]);

// Process form to login.
Route::post('/login', [
    'as' => 'login.submit',
    'uses' => 'LoginController@submit'
]);

// Process logout.
Route::post('/logout', [
    'as' => 'logout.submit',
    'uses' => 'LogoutController@submit'
]);


/*
 * Projects
 */

// Show form to create a project.
Route::get('/projects/create', [
    'as' => 'projects.create',
    'uses' => 'ProjectController@create'
]);

// Show summary page for a project.
Route::get('/projects/{project_id}', [
    'as' => 'projects.show',
    'uses' => 'ProjectController@show'
]);

// Process form to create a project.
Route::post('/projects', [
    'as' => 'projects.store',
    'uses' => 'ProjectController@store'
]);

// Show form to edit a project.
Route::get('/projects/{project_id}/edit', [
    'as' => 'projects.edit',
    'uses' => 'ProjectController@edit'
]);

// Process form to edit a project.
Route::put('/projects/{project_id}', [
    'as' => 'projects.update',
    'uses' => 'ProjectController@update'
]);

// Process form to delete a project.
Route::delete('/projects/{project_id}', [
    'as' => 'projects.destroy',
    'uses' => 'ProjectController@destroy'
]);


/*
 * Project Members
 */

// Show form to add a user to a project.
Route::get('/projects/{project_id}/members/add', [
    'as' => 'project_members.create',
    'uses' => 'ProjectMemberController@create'
]);

// Process form to add a user to a project.
Route::post('/projects/{project_id}/members', [
    'as' => 'project_members.store',
    'uses' => 'ProjectMemberController@store'
]);

// Process form to remove a user from a project.
Route::delete('/projects/{project_id}/members/{user_id}', [
    'as' => 'project_members.destroy',
    'uses' => 'ProjectMemberController@destroy'
]);


/*
 * Tasks
 */

// Show form to create a task.
Route::get('/projects/{project_id}/tasks/create', [
    'as' => 'tasks.create',
    'uses' => 'TaskController@create'
]);

// Process form to create a task.
Route::post('/projects/{project_id}/tasks', [
    'as' => 'tasks.store',
    'uses' => 'TaskController@store'
]);

// Show form to edit a task.
Route::get('/projects/{project_id}/tasks/{task_id}/edit', [
    'as' => 'tasks.edit',
    'uses' => 'TaskController@edit'
]);

// Process form to edit a task.
Route::put('/projects/{project_id}/tasks/{task_id}', [
    'as' => 'tasks.update',
    'uses' => 'TaskController@update'
]);

// Process form to delete a task.
Route::delete('/projects/{project_id}/tasks/{task_id}', [
    'as' => 'tasks.destroy',
    'uses' => 'TaskController@destroy'
]);
