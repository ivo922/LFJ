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

Route::get('showjob/{id}', 'JobsController@show');
Route::get('showuser/{id}', 'UsersController@show');
Route::get('edituser/{id}', 'UsersController@edit');
Route::put('updateuser/{id}', 'UsersController@update');
Route::post('banuser/{id}', 'UsersController@ban');
Route::post('updatePassword', 'UsersController@updatePassword');
Route::get('updatePassword', function(){ abort(404); });
Route::get('my-profile', 'UsersController@myProfile');
Route::post('jobsearch', 'SearchController@searchJobs');
Route::post('usersearch', 'SearchController@searchUsers');
Route::post('companysearch', 'SearchController@searchCompanies');

Route::resource('jobs', 'JobsController');
Route::resource('users', 'UsersController');
Route::resource('companies', 'CompaniesController');