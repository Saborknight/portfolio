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
		'avatar' => $faker->url,
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->unique()->randomElement(['photography', 'filmmaking', 'web development', 'graphic design', 'copywriting', 'writing']),
		'color' => $faker->hexColor
	];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {

	$name = $faker->sentence(rand(1,10));
	$regex = "/[[:space:][:punct:]]/";
	$permalink = trim($name, " \t\n\r\0\x0B.&+/*,-");
	$permalink = preg_replace($regex, '-', $permalink);
	$permalink = strtolower($permalink);

	return [
		'permalink' => $permalink,
		'name' => $name,
		'body' => $faker->paragraph,
		'state' => $faker->randomElement(['drafted', 'published', 'archived']),
		'start_date' => $faker->date(),
		'end_date' => $faker->date()
	];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {

	return [
		'name' => $faker->name,
		'avatar' => $faker->url,
		'type' => $faker->randomElement(['independent', 'company']),
		'link' => $faker->url,
		'biography' => $faker->paragraph
	];
});

$factory->define(App\ProjectFeedback::class, function (Faker\Generator $faker) {
	return [
		'project_id' => App\Project::all()->random()->id,
		'client_id' => App\Client::all()->random()->id,
		'title' => $faker->sentence(6),
		'body' => $faker->paragraph,
		'satisfaction' => $faker->randomDigit,
		'state' => $faker->randomElement(['drafted', 'published', 'archived'])
	];
});
