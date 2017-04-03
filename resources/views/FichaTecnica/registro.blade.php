@extends('master')
@section('script')
    @parent
    <script src="{{ asset('public/Js/FichaTecnica/registroFT.js') }}"></script>
    <script src="{{ asset('public/components/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
@stop
@section('content')
	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div class="content">
        <div id="main" class="row" data-url="{{ url('/') }}">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary" name="Enviar" id="Agregar_Ficha">
                    Agregar ficha técnica - ACEE
                </button>
            </div>
            <div class="col-md-12">
                <br>
            </div>
            <div class="col-md-12" id="TablaDatos">

            </div>
        </div>
        <div class="modal fade" id="AgregarFichaD" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="myModalLabel">Ficha técnica - ACEE</h3>
                    </div>
                    <form id="registroFichaTecnicaF" name="registroFichaTecnicaF">
                        <div class="modal-body">
                            <input type="hidden" id="Id_FT" name="Id_FT">
                            <div class="mensaje" id="mensaje" name="mensaje"></div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="inputEmail" class="control-label">Año:</label>
                                    <div class="input-group date" id="AnioDate">
                                        <input id="Anio" class="form-control " type="text" value="" name="Anio" default="" data-date="" data-behavior="Anio">
                                        <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputEmail" class="control-label">Fecha estimada de entrega:</label>
                                    <div class="input-group date" id="FechaEntregaDate">
                                        <input id="FechaEntrega" class="form-control " type="text" value="" name="FechaEntrega" default="" data-date="" data-behavior="FechaEntrega">
                                    <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputEmail" class="control-label">Subdirección:</label>
                                    <select name="Subdireccion" id="Subdireccion" class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach($Subdireccion as $Subdirecciones)
                                            <option value="{{ $Subdirecciones['Id'] }}">{{ $Subdirecciones['Nombre_Subdireccion'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputEmail" class="control-label">Presupuesto estimado:</label>
                                    <input type="number" class="form-control"  placeholder="Presupuesto estimado" id="Presupuesto" name="Presupuesto">
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
                                <div class="form-group col-md-12">
                                    <label for="inputEmail" class="control-label">Observaciones:</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea class="form-control"  placeholder="Observaciones" id="Observaciones" name="Observaciones"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div id="A1">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail" class="control-label">Alcance N° 1:</label>
                                        <div class="input-group date" id="Alcance1Date">
                                            <input id="Alcance1" class="form-control " type="text" value="" name="Alcance1" default="" data-date="" data-behavior="Alcance1">
                                            <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                        </div>
                                    </div>
                                </div>

                                <div id="A2">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail" class="control-label">Alcance N° 2:</label>
                                        <div class="input-group date" id="Alcance1Date">
                                            <input id="Alcance2" class="form-control " type="text" value="" name="Alcance2" default="" data-date="" data-behavior="Alcance2">
                                            <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                        </div>
                                    </div>
                                </div>

                                <div id="A3">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail" class="control-label">Alcance N° 3:</label>
                                        <div class="input-group date" id="Alcance1Date">
                                            <input id="Alcance3" class="form-control " type="text" value="" name="Alcance3" default="" data-date="" data-behavior="Alcance3">
                                            <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" name="RegistrarFT" id="RegistrarFT">Registrar Ficha Técnica</button>
                            <button type="button" class="btn btn-primary" name="ModificarFT" id="ModificarFT">Modificar Ficha Técnica</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
@stop
