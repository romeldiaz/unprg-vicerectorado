<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notificacion;
use Auth;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificaciones = Notificacion::where('user_id',Auth::user()->id)->paginate(5);
        return view('notificaciones.index', compact('notificaciones'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
      $notificaciones = Notificacion::where('user_id',Auth::user()->id)->paginate(5);
      $notificacion = Notificacion::findOrFail($id);
      //dd($notificacion->tipo);
      return view('notificaciones.show', compact('notificaciones', 'notificacion'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        //
    }
}
