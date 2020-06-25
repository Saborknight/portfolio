<?php

use Illuminate\Database\Seeder;
use App\Category;

class ProdCategoryTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Category::create([
			'name' => 'photography',
			'color' => '#FF9967'
		]);
		Category::create([
			'name' => 'film',
			'color' => '#609B56'
		]);
		Category::create([
			'name' => 'web development',
			'color' => '#89401C'
		]);
		Category::create([
			'name' => 'videogame modding',
			'color' => '#4834CA'
		]);
	}
}
