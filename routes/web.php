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
	$links = [
		'projects' => url('/projects'),
		'facebook' => 'https://facebook.com/Saborknight',
		'github' => 'https://github.com/Saborknight/portfolio'
	];

	return view('welcome', compact('links'));
});

Route::get('/projects', function() {
	$projects = [
		'A bunch of projects',
		'will eventually be displayed here.'
	];

	return view('projects', compact('projects'));
});

Auth::routes();

Route::get('/home', 'HomeController@index');
