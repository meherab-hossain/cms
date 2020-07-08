<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'type'=>'admin',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(Post::class, function (Faker $faker) {
    $title=$faker->sentence;
    return [
        'user_id'=>function() {
            return User::all()->random();
        },
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->text,
        'image'=>'deafult-image-2020-07-08-5f05ecc15b28b.jpg',
        'type'=>'section1',
        'is_approved'=>true
    ];
});

$factory->define(\App\Video::class, function (Faker $faker) {
    $title=$faker->sentence;
    return [
        'user_id'=>function() {
            return User::all()->random();
        },
        'title' => $title,
        'video' => 'https://www.youtube.com/watch?v=rFpnH-0hIUE',
        'type'=>'section2',
        'is_approved'=>false
    ];
});

