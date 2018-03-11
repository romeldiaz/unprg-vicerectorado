<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meta;
use DB;
use App\MetaResponsable;
Use App\Actividad;
use Carbon\Carbon;

class MetaController extends Controller
{
    public function index()
    {
        return redirect('metas/create');

    }

    public function create()
    {
        $actividad_id =69;
        $actividad = Actividad::findOrFail($actividad_id);
        $responsables =   DB::table('responsable')
                          ->where('actividad_id', '=', $actividad_id)
                          ->join('usuario', 'responsable.usuario_id', '=', 'usuario.id')
                          ->select('responsable.id', 'usuario.nombre', 'usuario.paterno', 'usuario.materno')
                          ->get();

        $metas = Meta::where('actividad_id',$actividad_id)->get();
        $carbon = Carbon::now();
        $hoy = $carbon->format( 'Y-m-d');

        return view('metas.index', [
          'actividad'=>$actividad,
          'responsables'=>$responsables,
          'metas'=>$metas,
          'hoy'=>$hoy
        ]);
    }

    public function store(Request $request)
    {

      $rules = [
        'nombre'=>'required',
        'fecha_incio_esperada'=>'date',
        'fecha_fin_esperada'=>'date',
        'producto'=>'required',
        'presupuesto'=>'numeric',
        'estado'=>'required',
        'actividad_id'=>'required',
        'responsables'=>'required'
      ];

      $messages = [
        'nombre.required'=>'Nombre de meta requerido',
        'responsable_id.required'=>'Asigne un responsable para esta actividad'
      ];


      //store meta
      $this->validate($request, $rules, $messages);
      $meta = new Meta;
      $meta->nombre = $request->nombre;
      $meta->fecha_inicio_esperada = $request->fecha_inicio_esperada;
      $meta->fecha_fin_esperada = $request->fecha_fin_esperada;
      $meta->producto = $request->producto;
      $meta->presupuesto = $request->presupuesto;
      $meta->estado = $request->estado;
      $meta->actividad_id = $request->actividad_id;
      $meta->save();

      //store tabla:meta_responsable
      $meta_id= Meta::all()->last()->id;
      foreach ($request->responsables as $responsable_id) {
        $metaResponsable = new MetaResponsable;
        $metaResponsable->meta_id = $meta_id;
        $metaResponsable->responsable_id = $responsable_id;
        $metaResponsable->save();
      }
      return redirect('actividades/'.$request->actividad_id.'/metas/create');
    }

    public function show($id)
    {
      $meta = Meta::findOrFail($id);
      $responsables = MetaResponsable::where('meta_id', '=', $id)
      ->join('responsable', 'meta_responsable.responsable_id', '=', 'responsable.id')
      ->join('usuario', 'responsable.usuario_id', '=', 'usuario.id')
      ->join('oficina', 'usuario.oficina_id', '=', 'oficina.id')
      ->select('usuario.*', 'oficina.nombre as nombre_oficina')
      ->get();
      return view('metas.show', [
        'meta'=>$meta,
        'responsables'=>$responsables
      ]);
    }

    public function edit($actividad_id, $id)
    {
        $actividad = Actividad::findOrFail($actividad_id);
        $responsables =   DB::table('responsable')
                          ->where('actividad_id', '=', $actividad_id)
                          ->join('usuario', 'responsable.usuario_id', '=', 'usuario.id')
                          ->select('responsable.id', 'usuario.nombre', 'usuario.paterno', 'usuario.materno')
                          ->get();

        $metas = Meta::where('actividad_id',$actividad_id)->get();
        $meta = Meta::findOrFail($id);
        $meta_responsables = MetaResponsable::where('meta_id',$id)->get();
        $carbon = Carbon::now();
        $hoy = $carbon->format( 'Y-m-d');
        return view('metas.index', [
          'meta'=>$meta,
          'meta_responsables'=>$meta_responsables,
          'actividad'=>$actividad,
          'responsables'=>$responsables,
          'metas'=>$metas,
          'hoy'=>$hoy
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
          'nombre'=>'required',
          'fecha_incio_esperada'=>'date',
          'fecha_fin_esperada'=>'date',
          'producto'=>'required',
          'presupuesto'=>'numeric',
          'estado'=>'required',
          'actividad_id'=>'required'
        ];

        $messages = [
          'nombre.required'=>'Nombre de meta requerido'
        ];

        $this->validate($request, $rules, $messages);
        $meta = Meta::findOrFail($id);
        $meta->nombre = $request->nombre;
        $meta->fecha_inicio_esperada = $request->fecha_inicio_esperada;
        $meta->fecha_fin_esperada = $request->fecha_fin_esperada;
        $meta->producto = $request->producto;
        $meta->presupuesto = $request->presupuesto;
        $meta->estado = $request->estado;
        $meta->actividad_id = $request->actividad_id;
        $meta->save();

        //update tabla:meta_responsable
        $metaResponsable = MetaResponsable::where('meta_id',$id)->delete();
        $meta_id= Meta::all()->last()->id;
        foreach ($request->responsables as $responsable_id) {
          $metaResponsable = new MetaResponsable;
          $metaResponsable->meta_id = $meta_id;
          $metaResponsable->responsable_id = $responsable_id;
          $metaResponsable->save();
        }
        //return redirect('metas');
        return redirect('actividades/'.$request->actividad_id.'/metas/create');
    }

    public function destroy($actividad_id, $id)
    {

      //delete table: meta_responsable
      $metaResponsable = MetaResponsable::where('meta_id',$id)->delete();

      //delte table:meta
      $meta = Meta::destroy($id);//si se conoce la pk del modelo
      return redirect('actividades/'.$actividad_id.'/metas/create');
    }


    //functions scripts
    public function meta_js(Request $request){

      if($request->op == 'consultar_meta'){
        $info = [];
        $meta = Meta::findOrFail($request->meta_id);
        $responsables = MetaResponsable::where('meta_id', '=', $request->meta_id)
        ->join('responsable', 'meta_responsable.responsable_id', '=', 'responsable.id')
        ->join('usuario', 'responsable.usuario_id', '=', 'usuario.id')
        ->select('usuario.*')
        ->get();
        $info = ['meta'=>$meta, 'responsables'=>$responsables];
        return $info;
      }

    }
}
