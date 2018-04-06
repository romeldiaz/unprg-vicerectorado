<?php

use Faker\Generator as Faker;

$factory->define(App\Notificacion::class, function (Faker $faker) {
    $db_types = ['actividad', 'responsable'];
    $db_actions1 = ['crear', 'editar', 'eliminar'];//para tipos: actividad, meta
    $db_actions2 = ['asignar', 'reasignar','eliminar'];//para responsables
    $type = $db_types[rand(0,1)];//0,1,2,3
    $action = '';
    if($type=='actividad'){
      $type_id = App\Actividad::all()->random()->id;
      $action = $db_actions1[rand(0,2)];
    }elseif($type=='responsable'){
      $type_id = App\User::all()->random()->id;
      $action = $db_actions2[rand(0,2)];
    }
    return [
        'date' => \Carbon\Carbon::now()->subDays(rand(0,45)),
        'type' => $type,
        'type_id' => $type_id,
        'action'=> $action,
        'from' => rand(1,2),
        'to'=> rand(22,28),
        'detail'=>$faker->sentence(5),
        'checked'=>false,
    ];
});
