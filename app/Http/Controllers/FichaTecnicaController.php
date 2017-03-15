<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;



class FichaTecnicaController extends Controller
{

	public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}


    public function indexRegistro(){
		$datos = [
			'seccion' => 'Registro'
		];
		return view('FichaTecnica/registro', $datos);
    }

    public function indexEdicion(){
		$datos = [
			'seccion' => 'Edicion'
		];
		return view('FichaTecnica/edicion', $datos);
    }
    
}
