<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Source;
use App\Models\Check;
use Faker\Generator as Faker;

$factory->define(Source::class, function (Faker $faker) {
    return [
        'type' => 'github.com',
        'url' => 'https://github.com/monicahq/monica',
        'valid' => true,
    ];
});

$factory->define(Check::class, function (Faker $faker) {
    return [
        'source_id' => function () {
            return factory(App\Models\Source::class)->create()->id;
        },
        'watchers' => 216,
        'watchers_level' => 20,
        'stars' => 7850,
        'stars_level' => 38,
        'forks' => 944,
        'forks_level' => 27,
        'commits' => 1750,
        'commits_level' => 29,
    ];
});
