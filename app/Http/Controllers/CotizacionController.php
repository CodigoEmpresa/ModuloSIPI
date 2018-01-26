<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Proveedor;
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
        $insumo = Insumo::find($request->input('Id_Insumo'));
        $insumo->proveedores()->attach($request->input('Id_Proveedor'));
        $proveedor = Proveedor::find($request->input('Id_Proveedor'));

        return response()->json($proveedor);
    }

    public function remover(Request $request) {
        $insumo = Insumo::find($request->input('Id_Insumo'));
        $insumo->proveedores()->detach($request->input('Id_Proveedor'));

        return response()->json(true);
    }
}
