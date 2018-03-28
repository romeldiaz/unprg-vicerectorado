<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetaUpdateRequest extends FormRequest
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
			'nombre' 				=> 'required|max:255',
			'fecha_inicio' 			=> 'nullable|date',
			'fecha_fin' 			=> 'nullable|date',
			'producto' 				=> 'required|max:255',
			'presupuesto' 			=> 'required|numeric',
			'estado' 				=> 'required|in:E,F',
			'monitor_id' 			=> 'required|integer',
			// 'responsables'			=> 'required|array'
        ];
    }
}
