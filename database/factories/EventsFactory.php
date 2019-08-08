<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'eventname' => $faker->text(20),
        'datefrom' => $faker->date(),
        'dateto' => $faker->date(),
        'sun' => 1,
        'mon' => 1,
        'tue' => 1,
        'wed' => 1,
        'thu' => 1,
        'fri' => 1,
        'sat' => 1
    ];
});
