<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MetaStoreRequest;
use App\Http\Requests\MetaUpdateRequest;
use App\Http\Requests\MetaResponsablesRequest;

use App\Meta;
use App\Actividad;
use App\Responsable;
use App\Tipo_documento;
use App\User;
use Auth;

class MetaController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return redirect()->route('actividades.index');
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
		$actividad = Actividad::findOrFail($id);

        return view('metas.index', compact('actividad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MetaStoreRequest $request)
    {

		$datos = $request->all();

		$datos['creador_id'] = Auth::user()->id;

		$meta = Meta::create($datos);

		return redirect()->route('metas.create', $meta->actividad->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($actividad_id, $id)
    {
		$meta = Meta::findOrFail($id);
		$actividad = $meta->actividad;

		return view('metas.show', compact('meta', 'actividad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($actividad_id, $id)
    {
		$meta = Meta::findOrFail($id);
		$actividad = $meta->actividad;

		return view ('metas.index', compact('meta', 'actividad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MetaUpdateRequest $request, $id)
    {
		if($request->estado == 'P'){
			$request->fecha_fin = null;
			$request->fecha_inicio = null;
		}
		if($request->estado == 'E'){
			$request->fecha_fin = null;
			// $request->fecha_inicio = null;
		}
        $meta = Meta::find($id);

		$meta->fill($request->all())->save();

		return redirect()->route('metas.edit', [$meta->actividad->id, $meta->id])
						->with('info', 'Meta actualizada con éxito');
	}

	/**
     * Crear o Actualizar los responsables de cada meta.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function regResp(MetaResponsablesRequest $request, $id)
	{
		$meta = Meta::find($id);
		if($meta->responsables()->get()->count() == 0){
			$meta->responsables()->attach($request->get('responsables'));
		}
		else
		{
			$meta->responsables()->sync($request->get('responsables'));
		}

		return redirect()->route('metas.show', [$meta->actividad->id, $meta->id])
    					->with('info', 'Responsables de la meta actualizados con éxito');

	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Meta::find($id)->delete();

		return back()->with('info-delete', 'Eliminado correctamente');
	}
}
