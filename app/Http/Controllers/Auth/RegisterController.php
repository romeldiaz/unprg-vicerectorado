<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        $rules = [
          'nombres' => 'required|string|max:50',
          'paterno' => 'required|string|max:50',
          'materno' => 'required|string|max:50',
          'cuenta' => 'required|string|max:50|unique:users',
          'password' => 'required|string|min:6|confirmed',
          'oficina_id' => 'required',
        ];

        $messages = [
          'nombres.required' => 'Nombres requrido',
          'paterno.required' => 'Apellido paterno requerido',
          'materno.required' => 'Apellido materno requrido',
          'cuenta.required' => 'Cuenta requerida',
          'cuenta.unique' => 'El nombre de la cuenta ya exite',
          'password.required' => 'Clave requrida',
          'oficina_id.required' => 'Seleccione una oficina',
        ];
        return Validator::make($data, $rules, $messages);
    }


    protected function create(array $data)

    {
        return User::create([
            'nombres'=> $data['nombres'],
            'paterno'=> $data['paterno'],
            'materno'=> $data['materno'],
            'cuenta'=> $data['cuenta'],
            'correo'=> 'rohadira@outlook.es',
            'oficina_id'=> $data['oficina_id'],
            'password' => Hash::make($data['password']),

        ]);
    }
}
