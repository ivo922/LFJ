<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('showjob/{id}', 'JobsController@show');
Route::get('showuser/{id}', 'UsersController@show');
Route::get('edituser/{id}', 'UsersController@edit');
Route::post('updateuser/{id}', 'UsersController@update');
Route::post('banuser/{id}', 'UsersController@ban');

Route::resource('jobs', 'JobsController');
Route::resource('users', 'UsersController');