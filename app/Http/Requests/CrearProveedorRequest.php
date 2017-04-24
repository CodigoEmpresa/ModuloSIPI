<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CrearProveedorRequest extends Request
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
            'Ciudad' => 'required',
            'Direccion' => 'required',
            'Telefono' => 'required',
            'Email' => 'required',
            'Nombre_Contacto' => 'required'
        ];
    }
}
