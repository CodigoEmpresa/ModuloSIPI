<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Modelos\Cotizacion;
use App\Modelos\Item;
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
        $item = Item::find($request->input('Id_Item'));

        if (!$id)
            $cotizacion = new Cotizacion;
        else
            $cotizacion = Cotizacion::find($id);

        if ($request->has('Precio_Oficial') && $request->input('Precio_Oficial') == 1)
        {
            $item->load(['cotizaciones' => function($query){
                $query->where('Precio_Oficial', '1');
            }]);

            if ($item->cotizaciones->count())
            {
                $cotizacion_precio_oficial = $item->cotizaciones->first();
                $cotizacion_precio_oficial->Precio_Oficial = 0;
                $cotizacion_precio_oficial->save();
            }
        }

        $cotizacion->Id_Item = $request->input('Id_Item');
        $cotizacion->Id_Proveedor = $request->input('Id_Proveedor');
        $cotizacion->Precio_Oficial = $request->input('Precio_Oficial');
        $cotizacion->Precio = $request->input('Precio');
        $cotizacion->Precio_Calculo = $request->input('Precio_Calculo');
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
