<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meta;
use App\Gasto;
use App\Documento;
class GastoController extends Controller
{

    public function index()
    {
      return redirect()->action('GastoController@create', ['meta_id'=>'38']);
    }

    public function create($meta_id)
    {
        $meta = Meta::findOrFail($meta_id);
        $gastos = Gasto::all();
        $documentos = Documento::all();
        return view('gastos.index', [
          'meta'=>$meta,
          'gastos'=>$gastos,
          'documentos'=>$documentos
        ]);
    }


    public function store(Request $request)
    {
      $gasto = new Gasto;
      $gasto->descripcion = $request->descripcion;
      $gasto->monto = $request->monto;
      $gasto->numero = $request->numero;
      $gasto->fecha = $request->fecha;
      $gasto->tipo = $request->tipo;
      $gasto->meta_id = $request->meta_id;
      $gasto->save();
      return back();
      //return $this->create($request->meta_id);
    }

    public function show($id)
    {

    }

    public function edit($meta_id, $gasto_id)
    {
      $meta = Meta::findOrFail($meta_id);
      $gasto = Gasto::findOrFail($gasto_id);
      $gastos = Gasto::all();
      $documentos = Documento::all();
      return view('gastos.index', [
        'meta'=>$meta,
        'gasto'=>$gasto,
        'gastos'=>$gastos,
        'documentos'=>$documentos
      ]);
    }

    public function update(Request $request, $id)
    {
      $gasto = Gasto::findOrFail($id);
      $gasto->descripcion = $request->descripcion;
      $gasto->monto = $request->monto;
      $gasto->numero = $request->numero;
      $gasto->fecha = $request->fecha;
      $gasto->tipo = $request->tipo;
      $gasto->meta_id = $request->meta_id;
      $gasto->save();
      return back();
      //return $this->create($request->meta_id);
    }


    public function destroy($id)
    {
        $gasto = Gasto::findOrFail($id);
        $gasto->delete();
        return back();
    }
}
