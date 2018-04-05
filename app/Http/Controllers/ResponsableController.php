<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responsable;

class ResponsableController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //desactivar responsable
        $olds = Responsable::where('actividad_id', $request->actividad_id)->get();
        foreach ($olds as $key => $responsable) {
          $responsable->delete();

        }

        if(isset($request->usuarios)){
          foreach ($request->usuarios as $user_id) {
            $tmp = Responsable::where('actividad_id', $request->actividad_id)
                                ->withTrashed()->where('user_id', $user_id)
                                ->get()->last();
            //echo $tmp ."<br>";
            if(empty($tmp)){
              $new = new Responsable;
              $new->user_id = $user_id;
              $new->actividad_id = $request->actividad_id;
              $new->save();
              //notificacion al usuario de que a sido agregado
            }else{
              $tmp->restore();
              //notificaion al usuario de que a sido restaurado
            }
          }
        }



        foreach ($olds as $key => $old) {
          echo 'holas <br>';
          $r = Responsable::where('actividad_id', $request->actividad_id)
                            ->where('user_id', $old->user_id)->get()->last();
          dd($r);
          if(empty($r)){
            //return 'user_id '.$r->user_id.' a sido eliminado';
          }
        }
        return '<br>FIN';


      return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
