<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(App\User::class, 25)->create();
		
		App\User::create([
			'nombres' => 'Jefferson',
			'paterno' => 'Tejada',
			'materno' => 'Senmache',
			'cuenta' => 'jefryts',
			'password' => Hash::make('12345'),
			'remember_token' => str_random(10),
			'jefe' => true,
			'oficina_id' => rand(1,10),
		]);
    }
}
