<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CrearItemRequest;
use App\Modelos\Item;
use App\Modelos\Insumo;
use App\Modelos\Proveedor;
use Idrd\Usuarios\Repo\PersonaInterface;
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

	public function inicio()
	{
		$datos = [
			'seccion' => 'Gestor de items',
			'proveedores' => Proveedor::all()
		];

		return view('Items.formulario', $datos);
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

	public function buscarItem(Request $request, $item = '')
	{
		$items = Item::where('Nombre', 'LIKE', '%'.$item.'%')
						->orWhere('Descripcion', 'LIKE', '%'.$item.'%')
						->orWhere('Codigo', 'LIKE', '%'.$item.'%')
						->get();

		return response()->json($items);
	}

	public function obtenerItem(Request $request, $item = 0)
	{
		$item = Item::with('insumos', 'cotizaciones', 'cotizaciones.proveedor')->find($item);

		return response()->json($item);
	}

	public function crear(CrearItemRequest $request)
	{
		$id = $request->input('Id');
		if (!$id)
			$item = new Item;
		else
			$item = Item::find($id);

		$item->Codigo = $request->input('Codigo');
		$item->Nombre = $request->input('Nombre');
		$item->Descripcion = $request->input('Descripcion');
		$item->Unidad_De_Medida = $request->input('Unidad_De_Medida');
		$item->save();

		return response()->json($item);
	}

	public function agregarInsumo(Request $request)
	{
		$item = Item::find($request->input('item'));
		$item->insumos()->attach($request->input('insumo'), ['Cantidad' => $request->input('cantidad')]);

		return $this->obtenerItem($request, $request->input('item'));
	}

	public function removerInsumo(Request $request)
	{
		$item = Item::find($request->input('item'));
		$item->insumos()->detach($request->input('insumo'));

		$insumo = Insumo::find($request->input('insumo'));

		return response()->json($insumo);
	}
}
