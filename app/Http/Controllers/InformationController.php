<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationController extends Controller
{
	public function index() {
		$links = [
			'projects' => url('/projects'),
			'facebook' => 'https://facebook.com/Saborknight',
			'github' => 'https://github.com/Saborknight/portfolio'
		];

		return view('index', compact('links'));
	}

	public function about() {
		return view('about');
	}
}
