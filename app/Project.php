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
		return 'permalink';
	}

	public function scopeFilter($query, $filters) {
		if ($month = $filters['month']) {
			$query->whereMonth('start_date', Carbon::parse($month)->month);
		}

		if ($year = $filters['year']) {
			$query->whereYear('start_date', $year);
		}
	}
}
