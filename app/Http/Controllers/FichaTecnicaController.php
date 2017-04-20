<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Validator;
use App\Http\Requests\RegistroFT;
use App\Modelos\Subdireccion;
use App\Modelos\FichaTecnica;
use App\Modelos\Persona;

class FichaTecnicaController extends Controller
{

	public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

    public function indexRegistro()
	{
    	$Subdireccion = Subdireccion::all();

		$datos = [
			'seccion' => 'Gestor de fichas técnicas'
		];

		return view('FichaTecnica/registro', $datos)
			   ->with(compact('Subdireccion'));
    }

    public function registroFichaTecnica(RegistroFT $request)
	{
    	if ($request->ajax())
		{
    		$a = FichaTecnica::all()->last();

    		if($a == null)
			{
    			$Conteo = 500;
    		} else {
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
    			return response()->json(["Mensaje" => "La ficha técnica ha sido registrada con éxito.", "Id" => $FichaTecnica->Id]);
    		}else{
    			return response()->json(["Mensaje" => "Ocurrio un fallo en la inserción de ficha técnica, por favor intentelo más tarde."]);
    		}
    	}
    }

	public function detalles(Request $request, $id)
	{
		$ficha_tecnica = FichaTecnica::with('items', 'items.insumos', 'items.cotizaciones', 'items.cotizaciones.proveedor')->find($id);

		$datos = [
			'seccion' => 'Gestor de fichas técnicas',
			'ficha_tecnica' => $ficha_tecnica
		];

		return view('FichaTecnica/formulario-items', $datos);
	}

    public function GetFichaTecnicaDatos(Request $request)
	{
    	$FichaTecnica = FichaTecnica::with('subdireccion', 'persona')->where('Persona_Id', $this->Usuario[0])->get();
		$html ="";
		foreach ($FichaTecnica as $key) {

			$CodigoProceso = "<td>".$key->Codigo_Proceso."</td>";
			$Anio = "<td>".$key->Anio."</td>";
			$Subdireccion = "<td>".$key->subdireccion['Nombre_Subdireccion']."</td>";
			$Persona = "<td>".$key->persona['Primer_Nombre']." ".$key->persona['Segundo_Nombre']." ".$key->persona['Primer_Apellido']." ".$key->persona['Segundo_Apellido']." "."</td>";

			$Botones = '<td>
							<a href="'.url('fichaTecnica/'.$key->Id.'/detalles').'" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="bottom" title="Detalles">
								<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
							</a>
						</td>
						<td>
                          	<button type="button" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" data-funcion="modificarFicha" value="'.$key->Id.'" >
                              	<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                          	</button>
						</td>';


			$h = '<tr>'.$CodigoProceso.$Anio.$Subdireccion.$Persona.$Botones.'</tr>';
			$html = $html.$h;
		}
		$Resultado = "<table id='datosTabla' class='default display responsive no-wrap table table-min table-striped' width='100%' name='datosTabla'>
			        <thead>
			            <tr>
			            	<th width='30px'>Cod.</th>
			            	<th width='30px'>Año</th>
							<th width='60px'>Subdirección</th>
	                        <th>Persona encargada</th>
	                        <th width='30px' data-priority='2' class='no-sort'></th>
	                        <th width='30px' data-priority='2' class='no-sort'></th>
						</tr>
					</thead>
						<tbody>".$html."</tbody></table>";
		return ($Resultado);
	}

	public function GetFichaTecnicaDatosOne(Request $request, $id)
	{
    	$FichaTecnica = FichaTecnica::with('subdireccion', 'persona')->find($id);
		return $FichaTecnica;
	}

	public function modificarFichaTecnica(RegistroFT $request)
	{
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
