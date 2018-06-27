<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
Route::auth();
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'taskController@index');
    Route::get('/finish', 'taskController@finishTask');
    Route::post('/update/{id}', 'taskController@updateTask');
    Route::post('/task', 'taskController@addTask');
    Route::delete('/task/{id}', 'taskController@deleteTask');
    Route::get('/task/finish/{id}','taskController@updateToFinishedTask');
});

});

