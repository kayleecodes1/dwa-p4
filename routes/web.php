<?php

Route::get('/', [
    'as' => 'home.index',
    'uses' => 'HomeController@index'
]);

Route::get('/login', [
    'as' => 'login.index',
    'uses' => 'LoginController@index'
]);

Route::post('/login', [
    'as' => 'login.submit',
    'uses' => 'LoginController@submit'
]);
