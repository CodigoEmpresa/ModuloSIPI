<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use Exception;

use App\Http\Requests\RegistroFT;

use App\Modelos\Subdireccion;
use App\Modelos\FichaTecnica;

use App\Modelos\Persona;

class FichaTecnicaController extends Controller
{

	public function __construct(PersonaInterface $repositorio_personas){
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function indexRegistro(){
    	$Subdireccion = Subdireccion::all();
		$datos = [
			'seccion' => 'Registro'
		];
		return view('FichaTecnica/registro', $datos)
			   ->with(compact('Subdireccion'))
		;
    }

    public function registroFichaTecnica(RegistroFT $request){
    	
    	if ($request->ajax()) { 

    		$a = FichaTecnica::all()->last();

    		if($a == null){
    			$Conteo = 500;
    		}else{
    			$Conteo = $a->Codigo_Proceso+1;
    		}
    		
    		$FichaTecnica = new FichaTecnica;
    		$FichaTecnica->Subdireccion_Id = $request->Subdireccion;
    		$FichaTecnica->Persona_Id = $this->Usuario[0];
    		$FichaTecnica->Anio = $request->Anio;
    		$FichaTecnica->Codigo_Proceso = $Conteo;
    		$FichaTecnica->Objeto = $request->Objeto;
    		$FichaTecnica->Presupuesto_Estimado = $request->Presupuesto;
    		$FichaTecnica->Fecha_Entrega_Estimada = $request->FechaEntrega;
    		$FichaTecnica->Observacion = $request->Observaciones;
    		if($FichaTecnica->save()){
    			return response()->json(["Mensaje" => "La ficha técnica ha sido registrada con éxito.", 'Id' => $FichaTecnica->Id]); 
    		}else{
    			return response()->json(["Mensaje" => "Ocurrio un fallo en la inserción de ficha técnica, por favor intentelo más tarde."]); 
    		}
    	}
    }

    public function GetFichaTecnicaDatos(Request $request){
    	$FichaTecnica = FichaTecnica::with('subdireccion', 'persona')->where('Persona_Id', $this->Usuario[0])->get();
		$html ="";
		foreach ($FichaTecnica as $key) {			
			
			$CodigoProceso = "<td>".$key->Codigo_Proceso."</td>";
			$Anio = "<td>".$key->Anio."</td>";
			$Subdireccion = "<td>".$key->subdireccion['Nombre_Subdireccion']."</td>";
			$Persona = "<td>".$key->persona['Primer_Nombre']." ".$key->persona['Segundo_Nombre']." ".$key->persona['Primer_Apellido']." ".$key->persona['Segundo_Apellido']." "."</td>";

			$Botones = '<td><button type="button" class="btn-sm btn-info" data-funcion="verFicha" value="'.$key->Id.'" >
                                  <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
                              </button>
                              <button type="button" class="btn-sm btn-primary" data-funcion="modificarFicha" value="'.$key->Id.'" >
                                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                              </button></td>';


			$h = '<tr>'.$CodigoProceso.$Anio.$Subdireccion.$Persona.$Botones.'</tr>';
			$html = $html.$h;
		}
		$Resultado = "<table id='datosTabla' class='table' name='datosTabla'>
			        <thead>
			            <tr>
			            	<th>CÓDIGO DE PROCESO</th>
			            	<th>AÑO</th>
							<th>SUBDIRECCIÓN</th>                        
	                        <th>PERSONA ENCARGADA</th>	                        
	                        <th>OPCIONES</th>
						</tr>
					</thead>
						<tbody>".$html."</tbody></table>";
		return ($Resultado);
	}

	public function GetFichaTecnicaDatosOne(Request $request, $id){
    	$FichaTecnica = FichaTecnica::with('subdireccion', 'persona')->find($id);		
		return $FichaTecnica;
	}

	public function modificarFichaTecnica(RegistroFT $request){
    	
    	if ($request->ajax()) { 
    		$FichaTecnica = FichaTecnica::find($request->Id_FT);
    		$FichaTecnica->Subdireccion_Id = $request->Subdireccion;
    		$FichaTecnica->Anio = $request->Anio;
    		$FichaTecnica->Objeto = $request->Objeto;
    		$FichaTecnica->Presupuesto_Estimado = $request->Presupuesto;
    		$FichaTecnica->Fecha_Entrega_Estimada = $request->FechaEntrega;
    		$FichaTecnica->Observacion = $request->Observaciones;
    		$FichaTecnica->Alcance1 = $request->Alcance1;
    		$FichaTecnica->Alcance2 = $request->Alcance2;
    		$FichaTecnica->Alcance3 = $request->Alcance3;
    		if($FichaTecnica->save()){
    			return response()->json(["Mensaje" => "La ficha técnica ha sido modificada con éxito.", 'Id' => $FichaTecnica->Id]); 
    		}else{
    			return response()->json(["Mensaje" => "Ocurrio un fallo en la modificación de ficha técnica, por favor intentelo más tarde."]); 
    		}
    	}
    }
}