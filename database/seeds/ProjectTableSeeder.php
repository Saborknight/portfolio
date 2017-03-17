<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// AuthorTableSeeder is handling me just fine, initially... :)
		$project_ids = App\Project::all()->pluck('id');
		$projects = App\Project::findMany($project_ids);

		// But now I want some more authors on some of me!
		$authors = App\Author::all()->pluck('id');

		foreach ($projects as $project) {
			$author = $authors->random();

			$isDuplicate = DB::table('author_project')
				->where('author_id', $author)
				->where('project_id', $project->id)
				->get();

			if (rand(0,1) >= 1 && empty(json_decode($isDuplicate))) {
				$project->authors()->attach($author);
			}
		}

		// Link all of me with categories!
		$cats = App\Category::all()->pluck('id');

		foreach ($projects as $project) {
			$project->categories()->attach($cats->random(rand(1,2)));
		}
	}
}
