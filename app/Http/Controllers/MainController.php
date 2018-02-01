<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Illuminate\Http\Request;

class MainController extends Controller {

	protected $Usuario;
	protected $repositorio_personas;

	public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

	public function welcome()
	{
		$data['seccion'] = '';
		return view('welcome', $data);
	}

    public function index(Request $request)
	{
		//$fake_permissions = ['1307', '1', '0', '1', '0', '0', '0', '0'];
		//$fake_permissions = ['71766', '0', '1', '0', '1', '1', '1', '1'];
		$fake_permissions = null;

		if ($request->has('vector_modulo') || $fake_permissions)
		{
			$vector = $request->has('vector_modulo') ? urldecode($request->input('vector_modulo')) : $fake_permissions;
			$user_array = is_array($vector) ? $vector : unserialize($vector);
			$permissions_array = $user_array;

			$permisos = [
				'administrar_usuarios' => array_key_exists(1, $permissions_array) ? intval($permissions_array[1]) : 0,
				'gestion_de_fichas_tecnicas' => array_key_exists(1, $permissions_array) ? intval($permissions_array[2]) : 0,
				'administrar_fichas_tecnicas' => array_key_exists(1, $permissions_array) ? intval($permissions_array[3]) : 0,
				'gestion_de_categorias' => array_key_exists(1, $permissions_array) ? intval($permissions_array[4]) : 0,
				'gestion_de_insumos' => array_key_exists(1, $permissions_array) ? intval($permissions_array[5]) : 0,
				'gestion_de_cotizaciones' => array_key_exists(1, $permissions_array) ? intval($permissions_array[6]) : 0,
				'gestion_de_proveedores' => array_key_exists(1, $permissions_array) ? intval($permissions_array[7]) : 0,
				'gestion_de_precios_oficiales' => array_key_exists(1, $permissions_array) ? intval($permissions_array[7]) : 0
			];

			$_SESSION['Usuario'] = $user_array;
            $persona = $this->repositorio_personas->obtener($_SESSION['Usuario'][0]);

			$_SESSION['Usuario']['Recreopersona'] = [];
			$_SESSION['Usuario']['Roles'] = [];
			$_SESSION['Usuario']['Persona'] = $persona;
			$_SESSION['Usuario']['Permisos'] = $permisos;
			$this->Usuario = $_SESSION['Usuario'];
		} else {
			if (!isset($_SESSION['Usuario']))
				$_SESSION['Usuario'] = '';
		}

		if ($_SESSION['Usuario'] == '')
			return redirect()->away('http://www.idrd.gov.co/SIM/Presentacion/');

		return redirect('/welcome');
	}

	public function logout()
	{
		$_SESSION['Usuario'] = '';

		return redirect()->to('/');
	}
}
