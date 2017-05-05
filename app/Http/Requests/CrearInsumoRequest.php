<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CrearInsumoRequest extends Request
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
            'Nombre' => 'required',
            'Unidad_De_Medida' => 'required',
            'Foto_1' => 'file|image',
            'Foto_2' => 'file|image',
            'Foto_3' => 'file|image'
        ];
    }

    public function messages()
    {
        return [
            'Foto_1.image' => 'El campo foto 1 debe ser una archivo de imágen valido',
            'Foto_2.image' => 'El campo foto 2 debe ser una archivo de imágen valido',
            'Foto_3.image' => 'El campo foto 3 debe ser una archivo de imágen valido',
        ];
    }
}
