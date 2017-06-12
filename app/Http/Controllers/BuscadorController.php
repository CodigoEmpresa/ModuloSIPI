<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Insumo;

class BuscadorController extends Controller
{
    public function buscar(Request $request)
    {
        $term = $request->input('term', '');

        if($term)
        {
            $insumos = Insumo::with('cotizaciones.proveedor', 'item')->where('Nombre', 'LIKE', '%'.$term.'%')
                ->orWhere('Descripcion', 'LIKE', '%'.$term.'%')
                ->orWhereRaw('CONCAT(LPAD(Id_Item, 4, "0"), "-", Id) LIKE "%'.$term.'%"')
                ->get();
        } else {
            $insumos = null;
        }

        $datos = [
            'insumos' => $insumos,
            'seccion' => 'Buscador'
        ];

        return view('buscador.index', $datos);
    }
}
