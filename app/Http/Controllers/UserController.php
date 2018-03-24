<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Oficina;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{

    public function index()
    {
      return redirect('users/create');
    }

    public function create(Request $request)
    {
      $users = User::search($request->get('search'))->orderBy('id', 'asc')->paginate(10);
      $oficinas = Oficina::all();

      return view('users.index', compact('users', 'oficinas'));
    }

    public function store(Request $request)
    {
      $this->validate($request, $this->rules, $this->messages);
      /*
      $user = new User;
      $user->nombres = $request->nombres;
      $user->materno = $request->materno;
      $user->paterno = $request->paterno;
      $user->cuenta = $request->cuenta;
      $user->password = Hash::make($request->password);
      $user->jefe = is_null($request->jefe)?false:true;
      $user->oficina_id = $request->oficina_id;
      $user->save();
      */
      $datos = $request->all();
      $datos['password'] = Hash::make($request->password);
      User::create($datos);
      return redirect('users');
    }

    public function show($id)
    {

    }

    public function edit($id, Request $request)
    {
      $user = User::findOrFail($id);//datos del usuarios update
      $oficinas = Oficina::all();
      $users = User::search($request->get('search'))->orderBy('id', 'asc')->paginate(10);
      return view('users.index', [
        'user'=> $user,
        'users'=>$users,
        'oficinas'=>$oficinas,
      ]);
    }

    public function update(Request $request, $id)
    {
      $this->rules['cuenta'] = ['required', Rule::unique('users')->ignore($id)];
      $this->validate($request, $this->rules, $this->messages);

      $user = User::find($request->id);
      $user->create($request->all());
      return redirect('users');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('users');
    }


    public function post_js(Request $request){
      if($request->op=='oficina_disponible'){//verifica si la oficina aun no tiene un jefe asignado
        return User::where('oficina_id', '=', $request->oficina_id)
        ->where('jefe',1)
        ->get();
      }
    }


    public $rules = [
        'nombres'=>'required',
        'paterno'=>'required',
        'materno'=>'required',
        'cuenta' => 'required|string|max:50|unique:users',
        'password'=>'required',
        'oficina_id' => 'required',
    ];

    public $messages = [
      'nombres.required' => 'Nombres requerido',
      'paterno.required' => 'Apellido paterno requerido',
      'materno.required' => 'Apellido materno requerido',
      'cuenta.required' => 'Cuenta requerida',
      'cuenta.unique' => 'La cuenta no esta disponible',
      'password.required' => 'Contraseña requrida',
      'oficina_id.required' => 'Seleccione una oficina'
    ];

}
