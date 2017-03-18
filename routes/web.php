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

// Public routes
Route::get('/', function () {
	$links = [
		'projects' => url('/projects'),
		'facebook' => 'https://facebook.com/Saborknight',
		'github' => 'https://github.com/Saborknight/portfolio'
	];

	return view('index', compact('links'));
});

Route::group(['prefix' => 'projects'], function() {

	Route::get('/', 'ProjectsController@index')->name('projects');

	Route::get('/{project}', 'ProjectsController@single')->name('projects.single');

	Route::get('/{project}/store', 'ProjectsController@store')->name('projects.store');

});

// All authenticated routes
Auth::routes();

Route::get('/home', 'HomeController@index');
