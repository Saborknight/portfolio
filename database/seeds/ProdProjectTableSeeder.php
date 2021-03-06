<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Project;

class ProdProjectTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		try {
			$files = File::files('database/seeds/mdData');
		} catch (Illuminate\Filesystem\FileNotFoundException $exception) {
			die('Bad Url');
		}

		// 1
		Project::create([
			'name' => 'Correct Translations - WordPress Site',
			'body' => File::get($files[0]),
			'state' => 'published',
			'start_date' => Carbon::createFromDate(2017, 2, 15),
			'end_date' => Carbon::createFromDate(2017, 3, 7),
			'featured' => 'CTScreen.png',
			'permalink' => 'correct-translations'
		]);

		// 2
		Project::create([
			'name' => 'Orangetime - WordPress Site',
			'body' => File::get($files[1]),
			'state' => 'published',
			'start_date' => Carbon::createFromDate(2016, 10, 25),
			'end_date' => Carbon::createFromDate(2017, 2, 6),
			'featured' => 'OrangetimeScreen.png',
			'permalink' => 'orangetime'
		]);

		// 3
		Project::create([
			'name' => 'Naturpark Pürkersdorf - WordPress Site',
			'body' => File::get($files[2]),
			'state' => 'published',
			'start_date' => Carbon::createFromDate(2015, 10, 1),
			'end_date' => Carbon::createFromDate(2016, 1, 28),
			'featured' => 'NaturparkPurkersdorfScreen.png',
			'permalink' => 'naturpark-purkersdorf'
		]);

		// 4
		Project::create([
			'name' => 'Leeds Ethical Hacking Society - Static Site',
			'body' => File::get($files[3]),
			'state' => 'published',
			'start_date' => Carbon::createFromDate(2016, 4, 5),
			'end_date' => Carbon::createFromDate(2016, 4, 11),
			'featured' => 'LEHSScreen.png',
			'permalink' => 'leeds-ethical-hacking-society'
		]);

		// 5
		Project::create([
			'name' => 'Student Union - HTML E-mail',
			'body' => File::get($files[4]),
			'state' => 'published',
			'start_date' => Carbon::createFromDate(2014, 10, 1),
			'end_date' => Carbon::createFromDate(2014, 11, 26),
			'featured' => 'SUEmailScreen.png',
			'permalink' => 'student-union'
		]);

		// 6
		Project::create([
			'name' => 'iWF Landing Page - Static Site',
			'body' => File::get($files[5]),
			'state' => 'published',
			'start_date' => Carbon::createFromDate(2014, 12, 1),
			'end_date' => Carbon::createFromDate(2015, 4, 1),
			'featured' => 'iWF-2Screen.png',
			'permalink' => 'iwf-landing-page'
		]);

		// 7
		Project::create([
			'name' => 'Betr - WordPress Site',
			'body' => File::get($files[6]),
			'state' => 'published',
			'start_date' => Carbon::createFromDate(2018, 6, 13),
			'end_date' => Carbon::createFromDate(2018, 10, 29),
			'featured' => 'BetrScreen.png',
			'permalink' => 'betr'
		]);

		// 8
		Project::create([
			'name' => 'Este Couture - WordPress Site',
			'body' => File::get($files[7]),
			'state' => 'published',
			'start_date' => Carbon::createFromDate(2017, 4, 1),
			'end_date' => Carbon::createFromDate(2017, 6, 30),
			'featured' => 'EsteScreen.png',
			'permalink' => 'este-couture'
		]);

		// 9
		Project::create([
			'name' => 'Three Counties Water - WordPress Site',
			'body' => File::get($files[8]),
			'state' => 'published',
			'start_date' => Carbon::createFromDate(2017, 6, 1),
			'end_date' => Carbon::createFromDate(2017, 6, 30),
			'featured' => '3cwScreen.png',
			'permalink' => 'three-counties-water'
		]);

		// 10
		Project::create([
			'name' => '2BNB Extras - Arma 3',
			'body' => File::get($files[9]),
			'state' => 'published',
			'start_date' => Carbon::createFromDate(2019, 2, 12),
			'featured' => '2bnbExtrasScreen.png',
			'permalink' => '2bnb-extras'
		]);

		// 11
		Project::create([
			'name' => '9Liners & Notepad - Arma 3',
			'body' => File::get($files[10]),
			'state' => 'published',
			'start_date' => Carbon::createFromDate(2017, 12, 10),
			'end_date' => Carbon::createFromDate(2018, 12, 12),
			'featured' => '9LinersAndNotepadScreen.png',
			'permalink' => '9liners-and-notepad'
		]);

		$category_project = [
			1 => [3],
			2 => [3],
			3 => [3],
			4 => [3],
			5 => [3],
			6 => [3],
			7 => [3],
			8 => [3],
			9 => [3],
			10 => [4],
			11 => [4]
		];

		// Now run the attachments and modifications
		$projects = App\Project::all();

		$this->attachAuthors($projects);
		$this->attachCategories($projects, $category_project);
		$this->modifyPermalink($projects);
	}

	/**
	 * Randomly attach more authors to some projects
	 * @param  object $projects collection of projects
	 * @return void           sets data in the database
	 */
	public function attachAuthors($projects) {
		$authors = App\Author::first()->pluck('id');

		$project_ids = $projects->pluck('id');

		foreach ($projects as $project) {
			$author = $authors;

			$isDuplicate = DB::table('author_project')
				->where('author_id', $author)
				->where('project_id', $project->id)
				->get();

			if (empty(json_decode($isDuplicate))) {
				$project->authors()->attach($author);
			}
		}
	}

	/**
	 * Attach random categories to projects
	 * @param  object $projects collection of projects
	 * @return void           sets data in the database
	 */
	public function attachCategories($projects, $list) {
		foreach ($projects as $project) {
			$project->categories()->attach($list[$project->id]);
		}
	}

	/**
	 * Modifies the pre-existing permalink which was generated by the factory
	 * to prefix with the id and a '-' separator
	 * @param  object $projects collection of projects
	 * @return void           sets data in the database
	 */
	public function modifyPermalink($projects) {

		foreach ($projects as $project) {
			$old_permalink = $project->permalink;
			$project_id = $project->id;

			$new_permalink = $project_id . '-' . $old_permalink;

			DB::table('projects')
				->where('id', $project_id)
				->update(['permalink' => $new_permalink]);
		}
	}
}
