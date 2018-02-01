<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Precio;
use App\Http\Requests\CrearPrecioRequest;

class PrecioController extends Controller
{
	protected $Usuario;

	public function __construct()
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];
	}

	public function crear(CrearPrecioRequest $request) 
	{
		$precio = new Precio;

		$precio->Id_Insumo = $request->input('Id_Insumo');
		$precio->Persona_Id = $_SESSION['Usuario'][0];
		$precio->Precio_Oficial = $request->input('Precio_Oficial');
		$precio->Precio_Oficial_Fecha = $request->input('Precio_Oficial_Fecha');
		$precio->IVA = $request->has('IVA') ? 1 : 0;

		$precio->save();
		return $precio;
	}
}