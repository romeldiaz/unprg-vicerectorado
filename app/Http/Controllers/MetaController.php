<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MetaStoreRequest;
use App\Http\Requests\MetaUpdateRequest;

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
		return redirect()->route('metas.create');
	}
	
	// public function showAll(){
	// 	// Muestra las metas a las que a sido asignado como responsable
	// 	$responsables = Responsable::where('user_id', Auth::user()->id)->get();
    //   	return view('metas.showAll', compact('responsables'));
    // }

    // public function showMy(){
    //   	// Muestra las metas creadas por el usuario
    //   	$metas = Meta::where('creador_id', Auth::user()->id)->get();
    //   	return view('metas.showMy', compact('metas'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$actividades = User::find(Auth::user()->id)->actividades;
		
        return view('metas.create', compact('actividades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MetaStoreRequest $request)
    {
		$meta = Meta::create($request->all());

		// $meta = Meta::find($meta->id);
		
		// $actividad = Actividad::where('id', $meta->actividad->id);

		// Responsables
		// $meta->responsables()->attach($request->get('responsables'));
		
		return redirect()->route('metas.edit', $meta->id)
						->with('info', 'Meta creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$meta = Meta::findOrFail($id);
		$documentos = Tipo_documento::all();
		
		return view ('metas.show', compact('meta', 'documentos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		// $actividad = Actividad::findOrFail($actividad_id);
		$meta = Meta::findOrFail($id);

		return view ('metas.edit', compact('meta'));
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
        $meta = Meta::find($id);
		
		$meta->fill($request->all())->save();

		$meta->responsables()->sync($request->get('responsables'));

		return redirect()->route('metas.edit', $meta->id)
						->with('info', 'Meta actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Actividad::find($id)->delete();
		
		return back()->with('info-delete', 'Eliminado correctamente');
	}
}
