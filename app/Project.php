<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
