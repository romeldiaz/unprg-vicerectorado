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

		return redirect()->route('monitoreo.create', $monitoreo->meta->id)
						->with('info', 'Registro de monitoreo creado con éxito');
    }

    public function show($id)
    {
		//
    }

    public function edit($meta_id, $id)
    {
		$monitoreo = Monitoreo::findOrFail($id);
		$meta = $monitoreo->meta;

		return view ('monitoreos.index', compact('monitoreo', 'meta'));
    }

    public function update(Request $request, $id)
    {
        $monitoreo = Monitoreo::find($id);

		$monitoreo->fill($request->all())->save();

		return redirect()->route('monitoreo.create', $monitoreo->meta->id)
    					->with('info', 'Registro de monitoreo actualizado con éxito');

    }

    public function destroy($id)
    {
        Monitoreo::findOrFail($id)->delete();

		return back()->with('info-delete', 'Eliminado correctamente');
    }
}
