<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
	public function authors() {
		return $this->belongsToMany(Author::class);
	}

	public function categories() {
		return $this->belongsToMany(Category::class);
	}

	public function clients() {
		return $this->hasManyThrough(ProjectFeedback::class, Client::class);
	}

	public function feedbacks() {
		return $this->hasMany(ProjectFeedback::class);
	}

	public function getRouteKeyName() {
		$route = \Request::route()->getName();
		if ($route == 'projects.single') {
			$keyName = 'permalink';
		} else {
			$keyName = 'id';
		}

		return $keyName;
	}

	public function scopeFilter($query, $filters) {
		/**
		 * Filter by the month set in the GET request
		 * @return $query returns to the main query with the parsed month to match the database values
		 */
		if ($month = $filters['month']) {
			$query->whereMonth('start_date', Carbon::parse($month)->month);
		}

		/**
		 * Filter by the year set in the GET request
		 * @return $query returns to the main query with the parsed year to match the database values
		 */
		if ($year = $filters['year']) {
			// Don't let short dates (from people messing around) throw us off!
			if (strlen($year) < 4) {
				$year = \DateTime::createFromFormat('y', $year)->format('Y');
			}

			$query->whereYear('start_date', $year);
		}

		if ($category = $filters['category']) {
			$category_id = Category::where('name', $category)->pluck('id')->first();
			$posts = Category::find($category_id)->projects;

			foreach ($posts as $post) {
				$post_ids[] = $post->id;
			}

			$query->whereIn('id', $post_ids);
		}
	}
}
