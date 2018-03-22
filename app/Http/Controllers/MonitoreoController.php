<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Monitoreo;
use App\Meta;


class MonitoreoController extends Controller
{


  public function admin(Request $request){
    return $this->create($request->meta_id);
  }

  public function index($vista)
  {
    if($vista=='create'){
      return $this->create(48);
    }else{
      return $this->create(48);
    }

  }

  public function create($meta_id)
  {
      $meta = Meta::findOrFail($meta_id);
      $monitoreos = Monitoreo::all();
      $now = Carbon::now();
      $hoy = $now->format( 'Y-m-d');
      return view('monitoreos.index', [
        'hoy'=>$hoy,
        'monitoreos'=>$monitoreos,
        'meta'=>$meta
      ]);
  }

  public function store(Request $request)
  {
      $monitoreo = new Monitoreo();
      $monitoreo->fecha = $request->fecha;
      $monitoreo->descripcion = $request->descripcion;
      $monitoreo->observacion = $request->observacion;
      $monitoreo->meta_id = $request->meta_id;
      $monitoreo->save();
      return redirect('monitoreos');
  }

  public function show($id)
  {

  }

  public function edit(Request $request)
  {
      $meta = Meta::findOrFail($request->meta_id);
      $monitoreo = Monitoreo::findOrFail($request->monitoreo_id);
      $monitoreos = Monitoreo::all();
      $now = Carbon::now();
      $hoy = $now->format( 'Y-m-d');
      return view('monitoreos.index', [
        'meta'=>$meta,
        'monitoreo'=>$monitoreo,
        'hoy'=>$hoy,
        'monitoreos'=>$monitoreos
      ]);
  }

  public function update(Request $request, $id)
  {
      $monitoreo = Monitoreo::findOrFail($id);
      $monitoreo->fecha = $request->fecha;
      $monitoreo->descripcion = $request->descripcion;
      $monitoreo->observacion = $request->observacion;
      $monitoreo->save();
      return redirect('monitoreos');
  }

  public function destroy($id)
  {
      $tarea = Monitoreo::findOrFail($id);
      $tarea->delete();
      return redirect('monitoreos');
  }
}
