<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Topic;
use App\User;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    $user     = User::get()->first();
    $category = Category::get()->first();

    return [
        'user_id'     => 1,
        'category_id' => 1,
        'title'       => $faker->paragraph,
        'description' => $faker->text
    ];
});
