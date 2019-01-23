<?php

use Faker\Generator as Faker;
use App\Models\Departamento;

$factory->define(App\Models\Usuario::class, function (Faker $faker) {
    return [
        'uid' => $faker -> swiftBicNumber,
        'departamento_id' => function() {
            return Departamento::all()->random();
        },
        'displayName' => $faker -> name,
        'email' => $faker -> email,
        'photoURL' => $faker -> url
    ];
});
