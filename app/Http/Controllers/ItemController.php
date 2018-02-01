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
			'seccion' => 'Gestor de Insumos',
			'categorias' => Item::all()
		];

		return view('Items.formulario', $datos);
	}

	public function buscarItem(Request $request, $item = '')
	{
		$items = Item::with('insumos', 'insumos')->where('Nombre', 'LIKE', '%'.$item.'%')
						->orWhere('Descripcion', 'LIKE', '%'.$item.'%')
						->orWhereRaw('LPAD(Id, 4, "0") LIKE "%'.$item.'%"')
						->get();

		return response()->json($items);
	}

	public function obtenerItem(Request $request, $item = 0)
	{
		$item = Item::with('insumos')->find($item);

		return response()->json($item);
	}

	public function crear(CrearItemRequest $request)
	{
		$id = $request->input('Id');
		if (!$id)
			$item = new Item;
		else
			$item = Item::find($id);

		$item->Nombre = $request->input('Nombre');
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
