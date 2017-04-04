<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modelos\Item;
use App\Modelos\Insumo;
use Illuminate\Http\Request;

class ItemController extends Controller {

	protected $Usuario;
	protected $repositorio_personas;

	public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function obtenerUnidadesDeMedida()
    {
        $unidades_items = Item::select('Unidad_De_Medida')->groupBy('Unidad_De_Medida')->get()->toArray();
        $unidades_insumos = Insumo::select('Unidad_De_Medida')->groupBy('Unidad_De_Medida')->get()->toArray();
        $unidades_de_medida = array_merge($unidades_items, $unidades_insumos);
        $unidades = collect([]);

        foreach ($unidades_de_medida as $value) {
            $unidades->put($value, $value);
        }

        $unidades->sort();

        return response()->json($unidades->toArray());
    }
}
