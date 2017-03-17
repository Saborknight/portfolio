<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	public function feedbacks() {
		return $this->hasMany(ProjectFeedback::class);
	}
}
