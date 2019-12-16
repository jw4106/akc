<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'id' => rand(0,100),
        'title' => 'title',
        'description' => 'description',
        'address' => 'yes',
        'city' => 'Queens',
        'state' => 'NY',
        'zipcode' => '11364',
        'lat' => '73.7949W',
        'long' => '40.7282N'
    ];
});
