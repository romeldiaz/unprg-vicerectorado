<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficina;

class OficinaController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }
    
    public function index()
    {
        return redirect('oficinas/create');
    }

    public function create()
    {
      $oficinas = Oficina::all();
      return view('oficinas.index', [
        'oficinas'=>$oficinas
      ]);
    }

    public function store(Request $request)
    {
        $oficina = new Oficina;
        $oficina->nombre = $request->nombre;
        $oficina->save();
        return redirect('oficinas');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $oficina = Oficina::findOrFail($id);
        $oficinas = Oficina::all();
        return view('oficinas.index', [
          'oficina'=>$oficina,
          'oficinas'=>$oficinas
        ]);
    }

    public function update(Request $request, $id)
    {
        $oficina = Oficina::find($id);
        $oficina->nombre = $request->nombre;
        $oficina->save();
        return redirect('oficinas');
    }

    public function destroy($id)
    {
        $oficina = Oficina::find($id);
        $oficina->delete();
        return redirect('oficinas');
    }
}
