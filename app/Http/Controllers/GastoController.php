<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Gasto;
use App\Meta;
use App\Tipo_documento;

class GastoController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
		$meta = Meta::findOrFail($id);
		$documentos = Tipo_documento::all();

		return view('gastos.index', compact('meta', 'documentos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($meta_id, $id)
    {
        $gasto = Gasto::findOrFail($id);
		$meta = $gasto->meta;
		$documentos = Tipo_documento::all();

		return view ('gastos.index', compact('gasto', 'meta', 'documentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gasto::find($id)->delete();
		
		return back()->with('info-delete', 'Eliminado correctamente');
    }
}
