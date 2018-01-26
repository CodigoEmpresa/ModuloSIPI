<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Modelos\Proveedor;
use App\Modelos\Insumo;
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
        $id = $request->input('Id');
        if (!$id)
            $proveedor = new Proveedor;
        else
            $proveedor = Proveedor::find($id);

        $proveedor->Id_Item = $request->input('Id_Item');
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

    public function porInsumo(Request $request)
    {
        $insumo = Insumo::with('proveedores')->find($request->input('Id_Insumo'));

        $qb = Proveedor::where('Id_Item', $insumo->Id_Item);

        if ($insumo->proveedores->count() > 0) {
            $qb->whereNotIn('Id', $insumo->proveedores->pluck('Id')->toArray());
        }

        $proveedores = $qb->get();

        return response()->json($proveedores);
    }
}
