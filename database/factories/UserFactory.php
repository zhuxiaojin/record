<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'duty_id' => rand(1, 5),
        'mobile' => $faker->phoneNumber,
        'avatar' => $faker->imageUrl(),
        'password' => bcrypt('111111'), // secret
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Models\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'body' => $faker->sentence,
        'user_id' => rand(1, 20),
        'img' => $faker->imageUrl(),
    ];
});
$factory->define(App\Models\Version::class, function (Faker $faker) {
    return [
        'project_id' => rand(1, 20),
        'body' => $faker->sentence,
        'user_id' => rand(1, 20),
        'name' => $faker->name,
        'end_time' => $faker->dateTime,
        'is_end' => $faker->boolean,
    ];
});

$factory->define(App\Models\Step::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'color' => $faker->unique()->rgbCssColor,
    ];
});
$factory->define(App\Models\Record::class, function (Faker $faker) {
    return [
        'project_id' => rand(1, 20),
        'version_id' => rand(1, 25),
        'user_id' => rand(1, 20),
        'body' => $faker->sentence,
        'step_id' => rand(1, 5),
        'current_time' => $faker->date('Y-m-d'),
        'work_time' => rand(1, 10),
    ];
});