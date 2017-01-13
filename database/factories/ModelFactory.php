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

// $factory->define(App\Models\User::class, function (Faker\Generator $faker) {
//     static $password;

//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'password' => $password ?: $password = bcrypt('secret'),
//         'remember_token' => str_random(10),
//     ];
// });

$factory->define(App\Models\Post::class, function ($faker) {
    return [
        'title' => $faker->sentence(mt_rand(3, 10)),
        'content' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'excerpt' => join("\n\n", $faker->paragraphs(mt_rand(1, 3))),
        'seo_description' => join("\n\n", $faker->paragraphs(mt_rand(1, 3))),
        'seo_keywords' => join("\n\n", $faker->paragraphs(mt_rand(1, 3))),
        'published_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
    ];
});
