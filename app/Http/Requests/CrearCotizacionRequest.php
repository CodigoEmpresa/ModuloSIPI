<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CrearCotizacionRequest extends Request
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
            'Id_Proveedor' => 'required',
            'Precio' => 'required',
            'Fecha_Actualizacion' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Id_Proveedor.required' => 'El campo proveedor es requerido',
            'Fecha_Actualizacion.required' => 'El campo fecha de actualización es requerido',
        ];
    }
}
