<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CrearInsumoRequest;
use App\Modelos\Insumo;
use Idrd\Usuarios\Repo\PersonaInterface;
use Illuminate\Http\Request;

class InsumoController extends Controller {

	protected $Usuario;
	protected $repositorio_personas;

	public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

	public function inicio()
	{
		$datos = [
			'seccion' => 'Gestor de items'
		];

		return view('Items.formulario', $datos);
	}

	public function buscarInsumo(Request $request, $insumo = '')
	{
		$insumos = Insumo::where('Nombre', 'LIKE', '%'.$insumo.'%')
						->orWhere('Descripcion', 'LIKE', '%'.$insumo.'%')
						->orWhere('Id', 'LIKE', '%'.$insumo.'%')
						->get();

		return response()->json($insumos);
	}

	public function obtenerInsumo(Request $request, $insumo = '')
	{
		$insumo = Insumo::with('cotizaciones', 'cotizaciones.proveedor')->find($insumo);

		return response()->json($insumo);
	}

	public function crear(CrearInsumoRequest $request)
	{
		$id = $request->input('Id');
		if (!$id)
			$insumo = new Insumo;
		else
			$insumo = Insumo::find($id);

		$insumo->Id_Item = $request->input('Id_Item');
		$insumo->Nombre = $request->input('Nombre');
		$insumo->Descripcion = $request->input('Descripcion');
		$insumo->Unidad_De_Medida = $request->input('Unidad_De_Medida');
		$insumo->save();

		return response()->json($insumo);
	}
}
