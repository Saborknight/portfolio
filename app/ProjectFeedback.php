<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectFeedback extends Model
{
	public function project() {
		return $this->belongsTo(Project::class);
	}

	public function client() {
		return $this->belongsTo(Client::class);
	}
}
