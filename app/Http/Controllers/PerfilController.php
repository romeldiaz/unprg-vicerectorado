<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\User;
use App\Oficina;
use Auth;

class PerfilController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }

    public function index()
    {
      $cuenta =  Auth::user()->cuenta;
      $user = User::where('cuenta',$cuenta)->get()->last();//como es un unico registro
      $oficina = Oficina::findOrFail($user->oficina_id);
      return view('dashboard.perfil' , ['user'=>$user, 'oficina'=>$oficina]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
      $this->rules['cuenta'] = ['required', Rule::unique('usuario')->ignore($id)];
      $this->validate($request, $this->rules, $this->messages);

      $user = User::find($id);
      $user->nombres = $request->nombres;
      $user->materno = $request->materno;
      $user->paterno = $request->paterno;
      $user->cuenta = $request->cuenta;
      $user->password = Hash::make($request->password);
      $user->save();

      return back();
    }

    public function destroy($id)
    {

    }

    public $rules = [
        'nombres'=>'required',
        'paterno'=>'required',
        'materno'=>'required',
        'cuenta' => 'required|string|max:50|unique:usuario',
        'password'=>'required',
    ];

    public $messages = [
      'nombres.required' => 'Nombres requerido',
      'paterno.required' => 'Apellido paterno requerido',
      'materno.required' => 'Apellido materno requerido',
      'cuenta.required' => 'Cuenta requerida',
      'cuenta.unique' => 'La cuenta ya existe',
      'password.required' => 'Contraseña requrida',
    ];
}
