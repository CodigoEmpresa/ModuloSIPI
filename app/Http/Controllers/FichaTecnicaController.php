<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Idrd\Usuarios\Repo\Tipo;
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
			'seccion' => 'Gestor de fichas técnicas',
			'status' => session('status')
		];

		return view('ficha_tecnica.lista', $datos)
			   ->with(compact('Subdireccion'));
    }

    public function procesar(RegistroFT $request)
	{
		$a = FichaTecnica::all()->last();

		if($request->input('Id') == '0')
			$ficha_tecnica = new FichaTecnica;
		else
			$ficha_tecnica = FichaTecnica::find($request->input('Id'));

		$ficha_tecnica->Subdireccion_Id = $request->input('Subdireccion_Id');
		$ficha_tecnica->Administrador_Id = $request->input('Administrador_Id');
		$ficha_tecnica->Persona_Id = $request->input('Persona_Id');
		$ficha_tecnica->Anio = $request->input('Anio');
		$ficha_tecnica->Objeto = $request->input('Objeto');
		$ficha_tecnica->Presupuesto_Estimado = $request->input('Presupuesto_Estimado');
		$ficha_tecnica->Fecha_Entrega_Estimada = $request->input('Fecha_Entrega_Estimada');
		$ficha_tecnica->Fecha_De_Llegada = $request->input('Fecha_De_Llegada');
		$ficha_tecnica->Hora_De_Llegada = $request->input('Hora_De_Llegada');
		$ficha_tecnica->Observacion = $request->input('Observacion');
		$ficha_tecnica->Alcance1 = empty(trim($request->input('Alcance1'))) ? null : $request->input('Alcance1');
		$ficha_tecnica->Detalle_Alcance1 = empty(trim($request->input('Detalle_Alcance1'))) ? null : $request->input('Detalle_Alcance1');
		$ficha_tecnica->Alcance2 = empty(trim($request->input('Alcance2'))) ? null : $request->input('Alcance2');
		$ficha_tecnica->Detalle_Alcance2 = empty(trim($request->input('Detalle_Alcance2'))) ? null : $request->input('Detalle_Alcance2');
		$ficha_tecnica->Alcance3 = empty(trim($request->input('Alcance3'))) ? null : $request->input('Alcance3');
		$ficha_tecnica->Detalle_Alcance3 = empty(trim($request->input('Detalle_Alcance3'))) ? null : $request->input('Detalle_Alcance3');

		$ficha_tecnica->save();

		$this->establecerCodigoProceso($ficha_tecnica);
		$apus = json_decode($request->input('apus'));
		$to_sync = [];

		foreach ($apus as $apu)
		{
			$to_sync[$apu->Id] = ['Cantidad' => $apu->Cantidad];
		}

		$ficha_tecnica->insumos()->sync($to_sync);

		return redirect('fichaTecnica/'.$ficha_tecnica->Id.'/editar')->with(['status' => 'success']);
    }

	public function crear(Request $request)
	{
		$ficha_tecnica = null;

		return $this->popularFichaTecnica($ficha_tecnica);
	}

	public function editar(Request $request, $id)
	{
		$ficha_tecnica = FichaTecnica::with('insumos', 'insumos.cotizaciones', 'insumos.cotizaciones.proveedor')->find($id);

		return $this->popularFichaTecnica($ficha_tecnica);
	}

	public function eliminar(Request $request, $id)
	{
		$ficha_tecnica = FichaTecnica::with('insumos')->find($id);
		$ficha_tecnica->insumos()->detach();
		$ficha_tecnica->delete();

		return redirect('fichaTecnica')->with('status', 'success');
	}

    public function GetFichaTecnicaDatos(Request $request)
	{
		$query_builder = FichaTecnica::with('subdireccion', 'persona');
		$or = false;

		if($_SESSION['Usuario']['Permisos']['administrar_fichas_tecnicas'])
		{
			$query_builder->where('Administrador_Id', $this->Usuario[0])->get();
			$or = true;
		}
    	
    	if($_SESSION['Usuario']['Permisos']['administrar_fichas_tecnicas'])
    	{
    		if ($or)
    		{
    			$query_builder->orWhere('Persona_Id', $this->Usuario[0])->get();
    		} else {
    			$query_builder->where('Persona_Id', $this->Usuario[0])->get();
    		}
    	}

    	$fichas_tecnicas = $query_builder->get();

		$html = "";
		foreach ($fichas_tecnicas as $ficha) {

			$CodigoProceso = "<td>".$ficha->Codigo_Proceso."</td>";
			$Anio = "<td>".$ficha->Anio."</td>";
			$Subdireccion = "<td>".$ficha->subdireccion['Nombre_Subdireccion']."</td>";
			$Persona = '<td>$'.number_format($ficha->Presupuesto_Estimado, 0, '', '.').'</td>';
			$objeto = '<td>'.$ficha->Objeto.'</td>';
			$Botones = '<td>
							<a href="'.url('fichaTecnica/'.$ficha->Id.'/editar').'" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar">
								<i class="fa fa-pencil"></i>
							</a>
						</td>';


			$h = '<tr>'.$CodigoProceso.$Anio.$Subdireccion.$Persona.$objeto.$Botones.'</tr>';
			$html = $html.$h;
		}
		$Resultado = "<table id='datosTabla' class='default display responsive no-wrap table table-min table-striped' width='100%' name='datosTabla'>
					        <thead>
					            <tr>
					            	<th width='60px'>Cod.</th>
					            	<th width='60px'>Año</th>
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

	private function popularFichaTecnica($ficha_tecnica)
	{
		$tipo_gestor = Tipo::with('personas')
							->where('Id_Modulo', 40)
							->where('Nombre', 'Gestion SIPI')
							->first();

		$usuarios = $tipo_gestor->personas;

		if ($ficha_tecnica)
		{
			$perfil = $ficha_tecnica['Administrador_Id'] == $this->Usuario[0] ? 'Administrador' : 'Gestor';
		} else {
			$perfil = 'Administrador';
		}

		$datos = [
			'seccion' => 'Gestor de fichas técnicas',
			'ficha_tecnica' => $ficha_tecnica,
			'usuarios' => $usuarios,
			'perfil' => $perfil,
			'subdirecciones' => Subdireccion::all(),
			'status' => session('status')
		];

		return view('ficha_tecnica.formulario', $datos);
	}

	private function establecerCodigoProceso($ficha_tecnica)
	{
		$ficha_tecnica->Codigo_Proceso = $ficha_tecnica->subdireccion['Nombre_Subdireccion'].$ficha_tecnica['Anio'].'-'.$ficha_tecnica->Id;
		$ficha_tecnica->save();
	}
}
