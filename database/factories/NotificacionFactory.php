<?php

use Faker\Generator as Faker;

$factory->define(App\Notificacion::class, function (Faker $faker) {
    $tipos = ['Actividad', 'Meta', 'Monitoreo'];
    return [
        'fecha' => $faker->date('Y-m-d', 'now + 30 days'),
        'tipo' => $tipos[rand(0,2)],
        'enlace' => rand(1,30),
        'user_id' => 26,
        'read'=> rand(0,1),
    ];
});
