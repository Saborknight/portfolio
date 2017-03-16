<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	public function feedbacks() {
		return $this->hasMany(ProjectFeedback::class);
	}

	public function authors() {
		return $this->belongsTo(Author::class);
	}
}
