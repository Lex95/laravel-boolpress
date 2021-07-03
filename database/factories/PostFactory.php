<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence(3);
    return [
        "title" => $title,
        "content" => $faker->realText(100),
        "slug" => Str::slug($title),
        "category_id" => rand(1, 3)
    ];
});
