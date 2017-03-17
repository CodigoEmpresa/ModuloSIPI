@extends('master')     
@section('script')
    @parent
    <script src="{{ asset('public/Js/FichaTecnica/registroFT.js') }}"></script>
    <script src="{{ asset('public/components/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
@stop                        
@section('content') 	
	<center><h3>GESTOR FICHA TÉCNICA - ACEE</h3></center>
	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
	<div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
	<br>
    <div class="content">
    	<div align="right">
            <button type="button" class="btn btn-success" name="Enviar" id="Agregar_Ficha">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar ficha técnica - ACEE
            </button>
        </div>
        <br>
	    <div class="" id="TablaDatos">
        </div>
        <div class="modal fade bs-example-modal-lg" id="AgregarFichaD" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	        <div class="modal-dialog modal-lg">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                    <h3 class="modal-title" id="myModalLabel">FICHA TÉCNICA - ACEE</h3>
	                 </div>
			    	<form id="registroFichaTecnicaF" name="registroFichaTecnicaF">  
				    	<div class="content">
	                        <div class="panel">
	                        	<ul class="list-group" id="seccion_uno" name="seccion_uno">
                               		<li class="list-group-item">
                               			<input type="hidden" id="Id_FT" name="Id_FT">
								        <div class="row">
											<div class="form-group col-md-2">
												<label for="inputEmail" class="control-label">Año:</label>
											</div>

											<div class="form-group col-md-4">
								                <div class="input-group date form-control" id="AnioDate" style="border: none;">
								                    <input id="Anio" class="form-control " type="text" value="" name="Anio" default="" data-date="" data-behavior="Anio">
								                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
								                </div>  
								            </div>

								            <div class="form-group col-md-2">
												<label for="inputEmail" class="control-label">Subdirección:</label>
											</div>

											<div class="form-group col-md-4">
								                <select name="Subdireccion" id="Subdireccion" class="form-control">
							                        <option value="">Seleccionar</option>                   
							                        @foreach($Subdireccion as $Subdirecciones)
						                                <option value="{{ $Subdirecciones['Id'] }}">{{ $Subdirecciones['Nombre_Subdireccion'] }}</option>
						                            @endforeach
							                    </select>
								            </div>
									    </div>

									    <div class="row">
											<div class="form-group col-md-12">
												<label for="inputEmail" class="control-label">Objeto:</label>
											</div>

											<div class="form-group col-md-12">
								                <textarea class="form-control"  placeholder="Objeto" id="Objeto" name="Objeto"></textarea> 
								            </div>
							            </div>

									    <div class="row">

								            <div class="form-group col-md-2">
												<label for="inputEmail" class="control-label">Presupuesto estimado:</label>
											</div>

											<div class="form-group col-md-4">
								                <input type="text" class="form-control"  placeholder="Presupuesto estimado" id="Presupuesto" name="Presupuesto">
								            </div>

								            <div class="form-group col-md-2">
												<label for="inputEmail" class="control-label">Fecha estimada de entrega:</label>
											</div>

											<div class="form-group col-md-4">
								                <div class="input-group date form-control" id="FechaEntregaDate" style="border: none;">
								                    <input id="FechaEntrega" class="form-control " type="text" value="" name="FechaEntrega" default="" data-date="" data-behavior="FechaEntrega">
								                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
								                </div> 
								            </div>

									    </div>

									    <div class="row">									

								            <div class="form-group col-md-12">
												<label for="inputEmail" class="control-label">Observaciones:</label>
											</div>

											<div class="form-group col-md-12">
								                <textarea class="form-control"  placeholder="Observaciones" id="Observaciones" name="Observaciones"></textarea> 
								            </div>
									    </div>

									    <div class="row">		

									    	<div id="A1">							
									            <div class="form-group col-md-1">
													<label for="inputEmail" class="control-label">Alcance N° 1:</label>
												</div>

												<div class="form-group col-md-3">
									                <div class="input-group date form-control" id="Alcance1Date" style="border: none;">
									                    <input id="Alcance1" class="form-control " type="text" value="" name="Alcance1" default="" data-date="" data-behavior="Alcance1">
									                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
									                </div>
									            </div>
								            </div>

								            <div id="A2">
									            <div class="form-group col-md-1">
													<label for="inputEmail" class="control-label">Alcance N° 2:</label>
												</div>

												<div class="form-group col-md-3">
									                <div class="input-group date form-control" id="Alcance1Date" style="border: none;">
									                    <input id="Alcance2" class="form-control " type="text" value="" name="Alcance2" default="" data-date="" data-behavior="Alcance2">
									                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
									                </div>
									            </div>
								            </div>

								            <div id="A3">
									            <div class="form-group col-md-1">
													<label for="inputEmail" class="control-label">Alcance N° 3:</label>
												</div>

												<div class="form-group col-md-3">
									                <div class="input-group date form-control" id="Alcance1Date" style="border: none;">
									                    <input id="Alcance3" class="form-control " type="text" value="" name="Alcance3" default="" data-date="" data-behavior="Alcance3">
									                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
									                </div>
									            </div>
								            </div>
									    </div>

									    <div class="row">
											<div class="form-group col-md-12 pager">
												<button type="button" class="btn btn-primary" name="RegistrarFT" id="RegistrarFT">
						                            <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Registrar Ficha Técnica
						                        </button>
						                        <button type="button" class="btn btn-success" name="ModificarFT" id="ModificarFT">
						                            <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Modificar Ficha Técnica
						                        </button>
											</div>
									    </div>
									    <br>
									    <div class="mensaje" id="mensaje" name="mensaje"></div>
								    </li>
							    </ul>
						    </div>
					    </div>
				    </form>
			    </div>
		    </div>
	    </div>
	</div>        
@stop