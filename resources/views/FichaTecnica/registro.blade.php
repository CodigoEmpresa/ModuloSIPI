@extends('master')
@section('script')
    @parent
    <script src="{{ asset('public/Js/FichaTecnica/registroFT.js') }}"></script>
@stop
@section('content')
	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div class="content">
        <div id="main" class="row" data-url="{{ url('/') }}">
            <div class="col-xs-12">
                <ul class="nav nav-pills">
                    <li class="active"><a href="#" name="Enviar" id="Agregar_Ficha">Crear ficha técnica</a></li>
                </ul>
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
                        <h3 class="modal-title" id="myModalLabel">Ficha técnica</h3>
                    </div>
                    <form id="registroFichaTecnicaF" name="registroFichaTecnicaF">
                        <div class="modal-body">
                            <input type="hidden" id="Id_FT" name="Id_FT">
                            <div class="mensaje" id="mensaje" name="mensaje"></div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="Anio" class="control-label">Año:</label>
                                    <?php
                                        $anio = date('Y');
                                    ?>
                                    <select name="Anio" id="Anio" class="form-control" title="Seleccionar" data-live-search="true">
                                        @for($i=(+$anio); $i>(+$anio-50); $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail" class="control-label">Fecha estimada de entrega:</label>
                                    <input id="FechaEntrega" class="form-control " type="text" value="" name="FechaEntrega" data-role="datepicker">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Subdireccion" class="control-label">Subdirección:</label>
                                    <select name="Subdireccion" id="Subdireccion" class="form-control" title="Seleccionar" data-live-search="true">
                                        @foreach($Subdireccion as $Subdirecciones)
                                            <option value="{{ $Subdirecciones['Id'] }}">{{ $Subdirecciones['Nombre_Subdireccion'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Presupuesto" class="control-label">Presupuesto estimado:</label>
                                    <input type="number" class="form-control" placeholder="Presupuesto estimado" id="Presupuesto" name="Presupuesto" min="0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="Objeto" class="control-label">Objeto:</label>
                                    <textarea class="form-control" placeholder="Objeto" id="Objeto" name="Objeto"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="Observaciones" class="control-label">Observaciones:</label>
                                    <textarea class="form-control" placeholder="Observaciones" id="Observaciones" name="Observaciones"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div id="A1">
                                    <div class="form-group col-md-4">
                                        <label for="Alcance1" class="control-label">Alcance N° 1:</label>
                                        <input id="Alcance1" class="form-control" type="text" value="" name="Alcance1" data-role="datepicker">
                                    </div>
                                </div>
                                <div id="A2">
                                    <div class="form-group col-md-4">
                                        <label for="Alcance2" class="control-label">Alcance N° 2:</label>
                                        <input id="Alcance2" class="form-control" type="text" value="" name="Alcance2" data-role="datepicker">
                                    </div>
                                </div>
                                <div id="A3">
                                    <div class="form-group col-md-4">
                                        <label for="Alcance3" class="control-label">Alcance N° 3:</label>
                                        <input id="Alcance3" class="form-control" type="text" value="" name="Alcance3" data-role="datepicker">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" name="RegistrarFT" id="RegistrarFT">Crear</button>
                            <button type="button" class="btn btn-primary" name="ModificarFT" id="ModificarFT">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
@stop
