<?php

use App\Seller;
use Faker\Generator as Faker;

$factory->define(App\Professor::class, function (Faker $faker) {
    return [
        'nome'     => $faker->name,
    ];
});