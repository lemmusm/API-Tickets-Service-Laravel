<?php

use Faker\Generator as Faker;
use App\Models\Departamento;

$factory->define(App\Models\Usuario::class, function (Faker $faker) {
    return [
        'uid' => $faker -> swiftBicNumber,
        'departamento_id' => function() {
            return Departamento::all()->random();
        },
        'usuario' => $faker -> name,
        'email' => $faker -> email,
        'urlavatar' => $faker -> url
    ];
});
