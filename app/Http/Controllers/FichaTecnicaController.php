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

		return view('ficha_tecnica.lista', $datos)
			   ->with(compact('Subdireccion'));
    }

    public function procesar(RegistroFT $request)
	{
		$a = FichaTecnica::all()->last();

		if($request->input('Id') == '0')
			$fichatecnica = new FichaTecnica;
		else
			$fichatecnica = FichaTecnica::find($request->input('Id'));

		if($a == null)
			$conteo = 500;
		else
			$conteo = $a->Codigo_Proceso+1;

		$fichatecnica->Subdireccion_Id = $request->input('Subdireccion_Id');
		$fichatecnica->Persona_Id = $this->Usuario[0];
		$fichatecnica->Anio = $request->input('Anio');
		$fichatecnica->Codigo_Proceso = $request->input('Id') == '0' ? $conteo : $fichatecnica->Codigo_Proceso;
		$fichatecnica->Objeto = $request->input('Objeto');
		$fichatecnica->Presupuesto_Estimado = $request->input('Presupuesto_Estimado');
		$fichatecnica->Fecha_Entrega_Estimada = $request->input('Fecha_Entrega_Estimada');
		$fichatecnica->Observacion = $request->input('Observacion');
		$fichatecnica->save();

		$apus = json_decode($request->input('apus'));
		$to_sync = [];

		foreach ($apus as $apu)
		{
			$to_sync[$apu->Id] = ['Cantidad' => $apu->Cantidad];
		}

		$fichatecnica->items()->sync($to_sync);

		return redirect('fichaTecnica/'.$fichatecnica->Id.'/editar')->with(['status' => 'success']);
    }

	public function crear(Request $request)
	{
		$ficha_tecnica = null;

		return $this->popularFichaTecnica($ficha_tecnica);
	}

	public function editar(Request $request, $id)
	{
		$ficha_tecnica = FichaTecnica::with('items', 'items.insumos', 'items.cotizaciones', 'items.cotizaciones.proveedor')->find($id);

		return $this->popularFichaTecnica($ficha_tecnica);
	}

    public function GetFichaTecnicaDatos(Request $request)
	{
    	$FichaTecnica = FichaTecnica::with('subdireccion', 'persona')->where('Persona_Id', $this->Usuario[0])->get();
		$html = "";
		foreach ($FichaTecnica as $key) {

			$CodigoProceso = "<td>".$key->Codigo_Proceso."</td>";
			$Anio = "<td>".$key->Anio."</td>";
			$Subdireccion = "<td>".$key->subdireccion['Nombre_Subdireccion']."</td>";
			$Persona = '<td>$'.number_format($key->Presupuesto_Estimado, 0, '', '.').'</td>';
			$objeto = '<td>'.$key->Objeto.'</td>';
			$Botones = '<td>
							<a href="'.url('fichaTecnica/'.$key->Id.'/editar').'" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar">
								<i class="fa fa-pencil"></i>
							</a>
						</td>';


			$h = '<tr>'.$CodigoProceso.$Anio.$Subdireccion.$Persona.$objeto.$Botones.'</tr>';
			$html = $html.$h;
		}
		$Resultado = "<table id='datosTabla' class='default display responsive no-wrap table table-min table-striped' width='100%' name='datosTabla'>
			        <thead>
			            <tr>
			            	<th width='30px'>Cod.</th>
			            	<th width='30px'>Año</th>
							<th width='60px'>Subdirección</th>
	                        <th width='140px'>Presupuesto estimado</th>
							<th>Objeto</th>
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
    	if ($request->ajax())
		{
    		$FichaTecnica = FichaTecnica::find($request->Id_FT);
    		$FichaTecnica->Subdireccion_Id = $request->Subdireccion;
    		$FichaTecnica->Anio = $request->Anio;
    		$FichaTecnica->Objeto = $request->Objeto;
    		$FichaTecnica->Presupuesto_Estimado = $request->Presupuesto;
    		$FichaTecnica->Fecha_Entrega_Estimada = $request->FechaEntrega;
    		$FichaTecnica->Observacion = $request->Observaciones;
    		$FichaTecnica->Alcance1 = trim($request->Alcance1) == '' ? null : $request->Alcance1;
    		$FichaTecnica->Alcance2 = trim($request->Alcance2) == '' ? null : $request->Alcance2;
    		$FichaTecnica->Alcance3 = trim($request->Alcance3) == '' ? null : $request->Alcance3;

    		if($FichaTecnica->save()){
    			return response()->json(["Mensaje" => "La ficha técnica ha sido modificada con éxito.", 'Id' => $FichaTecnica->Id]);
    		}else{
    			return response()->json(["Mensaje" => "Ocurrio un fallo en la modificación de ficha técnica, por favor intentelo más tarde."]);
    		}
    	}
    }

	private function popularFichaTecnica($ficha_tecnica)
	{
		$datos = [
			'seccion' => 'Gestor de fichas técnicas',
			'ficha_tecnica' => $ficha_tecnica,
			'subdirecciones' => Subdireccion::all(),
			'status' => session('status')
		];

		return view('ficha_tecnica.formulario', $datos);
	}
}
