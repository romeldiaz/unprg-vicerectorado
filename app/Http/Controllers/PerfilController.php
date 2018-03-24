<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use Session;

class PerfilController extends Controller
{
    public function index()
    {
      $user = User::findOrFail(Auth::user()->id);
      return view('perfil.index', compact('user'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit()//vista para editar datos del usuario
    {
      $user = User::findOrFail(Auth::user()->id);
      return view('perfil.edit', compact('user'));
    }

    public function getImagen()//vista para editar imagen de usuario
    {
      $user = User::findOrFail(Auth::user()->id);
      return view('perfil.imagen', compact('user'));
    }

    public function postImagen()//vista para editar imagen de usuario
    {
      $user = User::findOrFail(Auth::user()->id);
      return view('perfil.imagen', compact('user'));
    }

    public function getPassword(){
      $user = User::findOrFail(Auth::user()->id);
      return view('perfil.password', compact('user'));
    }

    public function postPassword(Request $request){
      $rules = [
        'password'=> 'required',
        'password_new'=>'required_with:password',
      ];

      $messages = [
        'password.required'=>'Contraseña actual requerida',
        'password_new.required_with'=>'Nueva contraseña requerida',
      ];

      $this->validate($request, $rules, $messages);

      if(!Hash::check($request->password, Auth::user()->password)){
        Session::flash('error_password', 'Contraseña actual incorrecta');
        return back();
      }

      $user = User::findOrFail(Auth::user()->id);
      $user->password = Hash::make($request->password_new);
      $user->save();
      Auth::logout();
      return redirect('login');
    }

    public function update(Request $request)
    {
      $password = Hash::make($request->password);
      $rules = [
          'nombres'=>'required',
          'paterno'=>'required',
          'materno'=>'required',
          'cuenta' => ['required', Rule::unique('users')->ignore(Auth::user()->id)],
          'password' => 'required'
      ];

      $messages = [
        'nombres.required' => 'Nombres requerido',
        'paterno.required' => 'Apellido paterno requerido',
        'materno.required' => 'Apellido materno requerido',
        'cuenta.required' => 'Cuenta requerida',
        'cuenta.unique' => 'La cuenta no esta disponible',
        'password.required' => 'Contraseña requerida'
      ];

      $this->validate($request, $rules, $messages);

      if(!Hash::check($request->password, Auth::user()->password)){
        Session::flash('error_password', 'Contraseña incorrecta');
        return back()->withInput();
      }

      $user = User::findOrFail(Auth::user()->id);
      $user->nombres = $request->nombres;
      $user->paterno = $request->paterno;
      $user->materno = $request->materno;
      $user->cuenta = $request->cuenta;
      $user->save();
      return redirect('perfil');
    }

    public function destroy($id)
    {

    }


}
