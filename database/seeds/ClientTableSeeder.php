<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\Client::class, 6)->create();
	}
}
