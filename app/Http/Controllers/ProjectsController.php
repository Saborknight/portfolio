<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
	public function index(Project $projects) {
		$projects = Project::all();

		return view('projects.index', compact('projects'));
	}

	public function show() {
		$project = Project::find($id);

		return view('projects.show', compact('project'));
	}
}
