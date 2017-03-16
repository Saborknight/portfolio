<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Author::class, function (Faker\Generator $faker) {
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {

	return [
		'name' => $faker->sentence(5),
		'body' => $faker->paragraph,
		'start_date' => $faker->date(),
		'end_date' => $faker->date()
	];
});

$factory->define(App\ProjectFeedback::class, function (Faker\Generator $faker) {
	return [
		'project_id' => rand(1,12),
		'title' => $faker->sentence(6),
		'body' => $faker->paragraph,
		'satisfaction' => $faker->randomDigit,
		'state' => $faker->word
	];
});
