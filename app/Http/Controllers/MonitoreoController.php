<?php

namespace App\Http\Controllers;

use App\Meta;
use App\Monitoreo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonitoreoController extends Controller
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
     * Redirect to Actividades/index.
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
		$meta = Meta::findOrFail($id);
		$hoy = Carbon::now()->format('d-m-Y');
		
        return view('monitoreos.index', compact('meta', 'hoy'));
    }

    public function store(Request $request)
    {
		$monitoreo = Monitoreo::create($request->all());

        return redirect()->route('monitoreos.index', $monitoreo->meta->id);
    }

    public function show($id)
    {
		// $monitoreo = Meta::findOrFail($id);
		// $documentos = Tipo_documento::all();

		// return view('metas.show', compact('meta', 'documentos'));

    }

    public function edit(Request $request)
    {
        $meta = Meta::findOrFail($request->meta_id);
        $monitoreo = Monitoreo::findOrFail($request->monitoreo_id);
        $monitoreos = Monitoreo::all();
        $now = Carbon::now();
        $hoy = $now->format('Y-m-d');
        return view('monitoreos.index', [
            'meta' => $meta,
            'monitoreo' => $monitoreo,
            'hoy' => $hoy,
            'monitoreos' => $monitoreos,
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
