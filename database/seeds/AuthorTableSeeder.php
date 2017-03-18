<?php

use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\Author::class, 3)->create()->each(function($a) {
			$a->projects()->saveMany(
				factory(App\Project::class, 4)->make());
		});
	}
}
