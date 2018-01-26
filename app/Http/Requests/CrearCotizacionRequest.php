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
            'Id_Proveedor' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'Id_Proveedor.required' => 'Selecciona un proveedor para agregar al insumo'
        ];
    }
}
