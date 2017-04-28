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
            'Codigo' => 'required|unique:Insumos,Codigo,'.$this->input('Id'),
            'Nombre' => 'required',
            'Unidad_De_Medida' => 'required',
            'Precio' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'Codigo.required' => 'El campo código es requerido'
        ];
    }
}
