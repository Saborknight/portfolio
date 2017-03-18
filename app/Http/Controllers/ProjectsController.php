<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
	public function index(Project $projects) {
		$projects = Project::orderBy('start_date', 'desc')
			->filter(request(['month', 'year', 'category']))
			->get();

		$sort = Project::selectRaw('year(start_date) year, monthname(start_date) month, count(*) published')
			->groupBy('year', 'month')
			->orderByRaw('min(start_date) desc')
			->get()
			->toArray();

		return view('projects.index', compact('projects', 'sort'));
	}

	public function single(Project $project) {
		return $project;

		return view('projects.single', compact('project'));
	}

	public function store(Project $project) {
		return $project;
	}
}
