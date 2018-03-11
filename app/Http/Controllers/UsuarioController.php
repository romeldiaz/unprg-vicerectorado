<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Oficina;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function index()
    {
      return redirect('usuarios/create');
    }

    public function create()
    {
      $oficinas = Oficina::All();
      $usuarios = Usuario::All();
      return view('usuarios.index', [
        'oficinas'=>$oficinas,
        'usuarios'=>$usuarios
      ]);
    }

    public function store(Request $request)
    {



      $this->validate($request, $this->rules, $this->messages);

      $usuario = new Usuario;
      $usuario->nombres = $request->nombres;
      $usuario->materno = $request->materno;
      $usuario->paterno = $request->paterno;
      $usuario->cuenta = $request->cuenta;
      $usuario->password = Hash::make($request->password);
      $usuario->jefe = is_null($request->jefe)?false:true;
      $usuario->oficina_id = $request->oficina_id;
      $usuario->foto = 'usuario_default.png';
      $usuario->save();

      return redirect('usuarios');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
      $usuario = Usuario::findOrFail($id);//datos del usuarios update
      $usuarios = Usuario::All();
      $oficinas = Oficina::All();
      $checkOficina = Usuario::checkOficina($usuario->oficina_id);//para saber si aun no tiene jefe asignado
      return view('usuarios.index', [
        'usuario'=> $usuario,
        'usuarios'=>$usuarios,
        'oficinas'=>$oficinas,
        'checkOficina'=>$checkOficina
      ]);
    }

    public function update(Request $request, $id)
    {
      $this->rules['cuenta'] = ['required', Rule::unique('usuario')->ignore($id)];
      $this->validate($request, $this->rules, $this->messages);

      $usuario = Usuario::find($request->id);
      $usuario->nombres = $request->nombres;
      $usuario->materno = $request->materno;
      $usuario->paterno = $request->paterno;
      $usuario->cuenta = $request->cuenta;
      $usuario->password = Hash::make($request->password);
      $usuario->jefe = is_null($request->jefe)?false:true;
      $usuario->oficina_id = $request->oficina_id;
      $usuario->foto = 'usuario_default.png';
      $usuario->save();

      return redirect('usuarios');
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        $usuario->delete();
        return redirect('usuarios');
    }

    public function postCheckOficina(Request $request){
      if($request->ajax()){
        $checkOficina = Usuario::checkOficina($request->oficina_id);
        return response()->json($checkOficina);
      }
    }

    public function getTest(){
      return 'hola desde el controlador';
    }

    public $rules = [
        'nombres'=>'required',
        'paterno'=>'required',
        'materno'=>'required',
        'cuenta' => 'required|string|max:50|unique:usuario',
        'password'=>'required',
        'oficina_id' => 'required',
    ];

    public $messages = [
      'nombres.required' => 'Nombres requerido',
      'paterno.required' => 'Apellido paterno requerido',
      'materno.required' => 'Apellido materno requerido',
      'cuenta.required' => 'Cuenta requerida',
      'cuenta.unique' => 'La cuenta ya existe',
      'password.required' => 'Contraseña requrida',
      'oficina_id.required' => 'Seleccione una oficina'
    ];

}
