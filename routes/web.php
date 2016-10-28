<?php

Route::get('/', [
    'as' => 'home.index',
    'uses' => 'HomeController@index'
]);

Route::get('/register', [
    'as' => 'register.index',
    'uses' => 'RegisterController@index'
]);

Route::post('/register', [
    'as' => 'register.submit',
    'uses' => 'RegisterController@submit'
]);

Route::get('/login', [
    'as' => 'login.index',
    'uses' => 'LoginController@index'
]);

Route::post('/login', [
    'as' => 'login.submit',
    'uses' => 'LoginController@submit'
]);

Route::post('/logout', [
    'as' => 'logout.submit',
    'uses' => 'LogoutController@submit'
]);
