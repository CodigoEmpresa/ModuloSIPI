<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CrearItemRequest;
use App\Modelos\Item;
use App\Modelos\Insumo;
use Idrd\Usuarios\Repo\PersonaInterface;
use Illuminate\Http\Request;

class UnidadController extends Controller {

	protected $Usuario;
	protected $repositorio_personas;

	public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

	public function buscarUnidadesDeMedida(Request $request, $unidad = '')
	{
		$unidades_items = Item::where('Unidad_De_Medida', 'LIKE', '%'.$unidad.'%')->groupBy('Unidad_De_Medida')->get();
		$unidades_insumos = Insumo::where('Unidad_De_Medida', 'LIKE', '%'.$unidad.'%')->groupBy('Unidad_De_Medida')->get();
		$unidades_de_medida = array_merge($unidades_items->pluck('Unidad_De_Medida')->toArray(), $unidades_insumos->pluck('Unidad_De_Medida')->toArray());
		$unidades = collect([]);

		foreach ($unidades_de_medida as $value) {
			$unidades->put($value, $value);
		}

		$unidades->sort();

		return response()->json($unidades->toArray());
	}
}
