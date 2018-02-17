<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Oficina;
use App\Http\Requests\UsuarioRequest;

class UsuarioController extends Controller
{
    public function index()
    {
      $usuarios = Usuario::All();
      return view('usuarios.index', ['usuarios'=>$usuarios]);
    }

    public function create()
    {
      $oficinas = Oficina::All();
      return view('usuarios.create', ['oficinas'=>$oficinas]);
    }

    public function store(UsuarioRequest $request)
    {
      $usuario = new Usuario;
      $usuario->nombre = $request->nombre;
      $usuario->materno = $request->materno;
      $usuario->paterno = $request->paterno;
      $usuario->cuenta = $request->cuenta;
      $usuario->clave = $request->clave;
      $usuario->jefe = is_null($request->jefe)?false:true;
      $usuario->oficina_id = $request->oficina_id;
      $usuario->save();

      return redirect('usuarios');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
      $usuario = Usuario::findOrFail($id);//datos del usuarios update
      $oficinas = Oficina::All();
      $checkOficina = Usuario::checkOficina($usuario->oficina_id);//para saber si aun no tiene jefe asignado
      return view('usuarios.update', [
        'usuario'=> $usuario,
        'oficinas'=>$oficinas,
        'checkOficina'=>$checkOficina
      ]);
    }

    public function update(UsuarioRequest $request, $id)
    {
      $usuario = Usuario::find($request->id);
      $usuario->nombre = $request->nombre;
      $usuario->materno = $request->materno;
      $usuario->paterno = $request->paterno;
      $usuario->cuenta = $request->cuenta;
      $usuario->clave = $request->clave;
      $usuario->jefe = is_null($request->jefe)?false:true;
      $usuario->oficina_id = $request->oficina_id;
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
}
