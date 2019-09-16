<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\File;
use Faker\Generator as Faker;

$factory->define(File::class, function (Faker $faker) {
    return [
        'uuid' => $faker->unique()->randomNumber(20),
        'name' => 'FileName',
        'size' => $faker->randomNumber(5),
        'path' => 'public/',
        'private' => $faker->boolean()
    ];
});
