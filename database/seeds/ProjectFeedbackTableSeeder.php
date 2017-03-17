<?php

use Illuminate\Database\Seeder;

class ProjectFeedbackTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\ProjectFeedback::class, 12)->create();
	}
}
