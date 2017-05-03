<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Modelos\Proveedor;
use Idrd\Usuarios\Repo\PersonaInterface;
use App\Http\Requests\CrearProveedorRequest;

class ProveedorController extends Controller
{
    protected $Usuario;
	protected $repositorio_personas;

	public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function crear(CrearProveedorRequest $request)
    {
        $id = $request->input('Proveedor_Id');
        if (!$id)
            $proveedor = new Proveedor;
        else
            $proveedor = Proveedor::find($id);

        $proveedor->Nombre = $request->input('Nombre');
        $proveedor->Ciudad = $request->input('Ciudad');
        $proveedor->Direccion = $request->input('Direccion');
        $proveedor->Telefono = $request->input('Telefono');
        $proveedor->Email = $request->input('Email');
        $proveedor->Nombre_Contacto = $request->input('Nombre_Contacto');
        $proveedor->save();

        return response()->json($proveedor);
    }

    public function obtener(Request $request, $proveedor = '')
    {
        $proveedor = Proveedor::find($proveedor);

        return response()->json($proveedor);
    }
}
