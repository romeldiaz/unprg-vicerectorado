<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Usuario;

class FileController extends Controller
{
  public function uploadPhoto(Request $request, $id){
    if($request->hasFile('files')){

      $file = $request->file('files')[0];
      $ext = $file->getClientOriginalExtension();
      $nombre = md5('usuario'.$id);
      $foto = $nombre.'.'.$ext;

      //NOTA: antes verificar si ya existe este archivo y eliminarlo
      Storage::delete($foto);

      Storage::disk('local')->put($foto,  \File::get($file));


      //guardamos ruta en base de datos
      $usuario = Usuario::find($id);
      $usuario->foto = $foto;
      $usuario->save();
    }
    return back();
  }


}
