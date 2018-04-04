<?php

use Faker\Generator as Faker;

$factory->define(App\Notificacion::class, function (Faker $faker) {
    $tipos = ['Actividad', 'Meta', 'Monitoreo'];
    return [
        'date' => \Carbon\Carbon::now()->subDays(rand(0,45)),
        'type' => $tipos[rand(0,2)],
        'title' => $faker->sentence(3),
        'from' => rand(1,2),
        'to'=> rand(20,28),
        'detail'=>$faker->sentence(5),
        'checked'=>false,
    ];
});
