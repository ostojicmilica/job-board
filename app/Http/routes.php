<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
   return redirect('jobs/create');
});
Route::get('jobs', 'JobsController@index');
Route::get('jobs/create', 'JobsController@create');
Route::get('jobs/{id}', 'JobsController@show');
Route::post('jobs', 'JobsController@store');
