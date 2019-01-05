<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Departamento::class, function (Faker $faker) {
    return [
        'departamento' => $faker -> cityPrefix,
        'ubicacion' => $faker -> state 
    ];
});
