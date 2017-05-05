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
						->orWhereRaw('CONCAT(LPAD(Id_Item, 4, "0"), "-", Id) LIKE "%'.$insumo.'%"')
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

		if ($request->hasFile('Foto_1'))
		{
			$insumo->Foto_1 = $this->uploadFile($request->file('Foto_1'));
		}

		if ($request->hasFile('Foto_2'))
		{
			$insumo->Foto_2 = $this->uploadFile($request->file('Foto_2'));
		}

		if ($request->hasFile('Foto_3'))
		{
			$insumo->Foto_3 = $this->uploadFile($request->file('Foto_3'));
		}

		$insumo->save();

		return response()->json($insumo);
	}

	public function actualizarPrecioOficial(Request $request)
	{
		$id = $request->input('Id');
		$insumo = Insumo::find($id);

		$insumo->Precio_Oficial = $request->input('Precio_Oficial');
		$insumo->Precio_Oficial_Calculo = $request->input('Precio_Oficial_Calculo');
		$insumo->save();

		return response()->json($insumo);
	}

	private function uploadFile($file)
	{
		$path = public_path().'/storage';
		$filename = md5($file->getClientOriginalName().date('Y-m-d H:i:s:u')).'.'.$file->getClientOriginalExtension();
		$file->move($path, $filename);

		return $filename;
	}
}
