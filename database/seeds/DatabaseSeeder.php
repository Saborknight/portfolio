<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
	/**
	 * Truncate the databases before seeding new data
	 */
	protected $toTruncate = ['authors', 'author_project', 'categories', 'category_project', 'clients','projects','project_feedbacks'];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		/* Truncate first! */
		foreach ($this->toTruncate as $table) {
			DB::table($table)->truncate();
		}

		$this->call(AuthorTableSeeder::class);
		$this->call(CategoryTableSeeder::class);
		$this->call(ClientTableSeeder::class);
		$this->call(ProjectTableSeeder::class);
		$this->call(ProjectFeedbackTableSeeder::class);

		Model::reguard();
	}
}
