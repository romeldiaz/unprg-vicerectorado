<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oficina;

class OficinaController extends Controller
{
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
        Oficina::create($request->all());
        return redirect('oficinas');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $oficinas = Oficina::all();
      $oficina = Oficina::findOrFail($id);
      return view('oficinas.index', [
        'oficinas' => $oficinas,
        'oficina' => $oficina
      ]);
    }

    public function update(Request $request, $id)
    {
      $oficina = Oficina::findOrFail($id);
      $oficina->update($request->all());
      return redirect('oficinas');
    }

    public function destroy($id)
    {
        $oficina = Oficina::findOrFail($id);
        $oficina->delete();
        return redirect('oficinas');
    }

}
