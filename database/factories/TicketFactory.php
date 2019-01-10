<?php

use Faker\Generator as Faker;
use App\Models\Usuario;

$factory->define(App\Models\Ticket::class, function (Faker $faker) {
    return [
        'usuario_uid' => function() {
            return Usuario::all()->random();
        },
        'servicio' => $faker -> catchPhrase,
        'descripcion' => $faker -> streetAddress,
        'diagnostico' => $faker -> address,
        'tecnico' => $faker -> name,
        'status' => $faker -> word
    ];
});
