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
			'nombres' => 'Romel Hammerlin',
			'paterno' => 'Diaz',
			'materno' => 'Ramos',
			'cuenta' => 'rodira',
			'password' => Hash::make('123'),
			'remember_token' => str_random(10),
			'jefe' => true,
      'imagen' => 'default.jpg',
			'oficina_id' => rand(1,10),
		]);
    }
}
