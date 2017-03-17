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
            "Subdireccion" => "required",
            "Objeto" => "required",
            "Presupuesto" => "required|numeric",
            "FechaEntrega" => "required|date",
            "Observaciones" => "required",
        ];              
        return $validaciones;
    }
}
