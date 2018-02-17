<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficina;

class OficinaController extends Controller
{

    public function test(){
      return 'Hola test';
    }

    public function index()
    {
        $oficinas = Oficina::all();
        return view('oficinas.index', ['oficinas'=>$oficinas]);
    }

    public function create()
    {
      $oficinas = Oficina::all();
      return view('oficinas.create');
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
        return  view('oficinas.update', ['oficina'=>$oficina]);
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
