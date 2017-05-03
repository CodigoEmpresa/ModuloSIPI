<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Modelos\Cotizacion;
use App\Modelos\Insumo;
use Idrd\Usuarios\Repo\PersonaInterface;
use App\Http\Requests\CrearCotizacionRequest;

class CotizacionController extends Controller
{
    protected $Usuario;
	protected $repositorio_personas;

	public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function crear(CrearCotizacionRequest $request)
    {
        $id = $request->input('Id');
        $insumo = Insumo::find($request->input('Id_Insumo'));

        if (!$id)
            $cotizacion = new Cotizacion;
        else
            $cotizacion = Cotizacion::find($id);

        $cotizacion->Id_Insumo = $request->input('Id_Insumo');
        $cotizacion->Id_Proveedor = $request->input('Id_Proveedor');
        $cotizacion->Precio = $request->input('Precio');
        $cotizacion->Fecha_Actualizacion = $request->input('Fecha_Actualizacion');
        $cotizacion->Observaciones = $request->input('Observaciones');
        $cotizacion->save();

        $cotizacion->load('proveedor');

        return response()->json($cotizacion);
    }

    public function obtener(Request $request, $cotizacion = '')
    {
        $cotizacion = Cotizacion::with('proveedor')->find($cotizacion);

        return response()->json($cotizacion);
    }
}
