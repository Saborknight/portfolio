<?php

use Illuminate\Database\Seeder;

class ProdAuthorTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		App\Author::create([
				'name' => 'Anton Brink',
				'email' => 'support@saborknight.com',
				'password' => bcrypt('anton3614'),
				'avatar' => \URL::asset('images/avatar.jpg')
			]);
	}
}
