<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
	public function index(Project $projects) {
		$projects = Project::orderBy('start_date', 'desc')
			->filter(request(['month', 'year', 'category']))
			->get();

		$timeline = $this->getTimelineList($projects);

		return view('projects.index', compact('projects', 'timeline'));
	}

	public function single(Project $project) {

		$timeline = $this->getTimelineList();

		return view('projects.single', compact('project', 'timeline'));
	}

	public function store(Project $project) {
		return $project;
	}

	/**
	 * Get the timeline list in its year groups for the sidebar
	 * @return array years and their child projects
	 */
	public function getTimelineList($id = false) {
		if ($id) {
			$id = $id->pluck('id')->toArray();

			$projects = Project::select()
				->whereIn('id', $id)
				->orderBy('start_date', 'desc')
				->get();
		} else {
			$projects = Project::select()
				->orderBy('start_date', 'desc')
				->get();
		}

		$groupedProjects = $this->groupTimelineList($projects);

		return $groupedProjects;
	}

	/**
	 * Group the timeline lists for getTimelineList()
	 * @param  object $projects laravel object of projects
	 * @return array           years and their child projects
	 */
	public function groupTimelineList($projects) {

		foreach ($projects as $project) {

			if ($project->first()) {
				$year = new \DateTime($project->start_date);
				$year = $year->format('Y');
			}

			$array = $project->toArray();

			/**
			 * Inject categories colour into the main array, to avoid having
			 * to make a separate query just for that
			 */
			$color = $project->categories()->first()->color;
			$array['color'] = $color;

			/**
			 * Add the final project object to the main array under its
			 * relevant year
			 */
			$grouped[$year][] = $array;
		}

		return $grouped;
	}
}
