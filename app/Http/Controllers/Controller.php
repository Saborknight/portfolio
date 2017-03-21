<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function getMenuItems() {
		$menuItems = [
			'projects' => route('projects'),
			'about' => route('index'),
			'separator',
			'web CV' => 'http://saborknight.com/img/Anton_Brink_CV-Web.pdf',
			'film CV' => 'http://saborknight.com/img/Anton_Brink_CV-Film.pdf',
			'linkedIn' => 'https://www.linkedin.com/in/antonabrink',
			'facebook blog' => 'https://www.facebook.com/Saborknight'
		];

		return $menuItems;
	}
}
