<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistroFT extends Request
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
         $validaciones = [
            "Anio" => "required",
            "Subdireccion_Id" => "required",
            "Objeto" => "required",
            "Presupuesto_Estimado" => "required|numeric",
            "Fecha_Entrega_Estimada" => "required|date",
            'Fecha_De_Llegada' => 'required|date',
            'Hora_De_Llegada' => 'required',
            "Observacion" => "required",
        ];
        return $validaciones;
    }


    public function messages()
    {
        return [
            'Subdireccion_Id.required' => 'El campo subdirección es requerido',
            'Anio.required' => 'El campo año es requerido',
            'Presupuesto_Estimado.required' => 'El campo presupuesto estimado es requerido',
            'Fecha_Entrega_Estimada.required' => 'El campo fecha estimada de entrega es requerido',
            'Observacion.required' => 'El campo observaciones es requerido'
        ];
    }
}
