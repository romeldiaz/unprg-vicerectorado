<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=>'required',
            'paterno'=>'required',
            'materno'=>'required',
            'cuenta'=>'required',
            'clave'=>'required',
            'oficina_id' => 'required',
        ];
    }

    public function messages(){
      return[
        'nombre.required' => 'Nombre requrido',
        'paterno.required' => 'Apellido paterno requrido',
        'materno.required' => 'Apellido materno requrido',
        'cuenta.required' => 'Cuenta requrida',
        'clave.required' => 'Contraseña requrida',
        'oficina_id.required' => 'Seleccione una oficina'
      ];
    }
}
