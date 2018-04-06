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
    public function index(Request $request)
    {
        $notificaciones = Notificacion::search($request->get('search'))
                          ->where('to',Auth::user()->id)
                          ->orderBy('date', 'desc')
                          ->paginate(10);
        return view('notificaciones.index', compact('notificaciones'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function show(Request $request, $id)
    {
      $noti = Notificacion::findOrFail($id);
      $noti->checked = true;
      $noti->update();
      $notificaciones = Notificacion::where('to',Auth::user()->id)
                        ->orderBy('date', 'desc')
                        ->paginate(10);
      return view('notificaciones.index', compact('notificaciones', 'noti'));
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
