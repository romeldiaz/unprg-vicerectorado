<?php

use Faker\Generator as Faker;

$factory->define(App\Meta::class, function (Faker $faker) {
	$rand_act = App\Actividad::all()->random();
	$user = $rand_act->responsables()->get()->random();
	$monitor = $rand_act->responsables()->get()->random();
    return [
        'nombre' => $faker->sentence(2),
		'estado' => $faker->randomElement(['I', 'E', 'F']),
		'producto' => $faker->sentence(2),
		'presupuesto' => $faker->randomFloat(2, 1000, 10000),
		'fecha_inicio' => $faker->date('Y-m-d', 'now + 30 days'),
		'fecha_inicio_esperada' => $faker->date('Y-m-d', 'now + 30 days'),
		'fecha_fin' => $faker->date('Y-m-d', 'now + 30 days'),
		'fecha_fin_esperada' => $faker->date('Y-m-d', 'now + 30 days'),
		'actividad_id' => $rand_act->id,
		'creador_id' => $user->user_id,
		'monitor_id' => $monitor->user_id,
    ];
});