@extends('master')
@section('script')
    @parent
    <script src="{{ asset('public/Js/ficha_tecnica/formulario-autocomplete.js') }}"></script>
    <script src="{{ asset('public/Js/ficha_tecnica/formulario.js') }}"></script>
@stop
@section('content')
    <div class="row">
        @if ($status == 'success')
            <div id="alerta" class="col-xs-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Datos actualizados satisfactoriamente.
                </div>
            </div>
        @endif
        @if (!empty($errors->all()))
            <div class="col-xs-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Solucione los siguientes inconvenientes y vuelva a intentarlo</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="col-xs-12">
            <div class="row">
                <form id="form-ficha-tecnica" action="{{ url('fichaTecnica/procesar') }}" method="POST">
                    <div class="form-group col-md-3">
                        <label for="Código" class="control-label">Código</label>
                        <p class="form-control-static">{{ $ficha_tecnica ? $ficha_tecnica['Codigo_Proceso'] : 'Automático' }}</p>
                    </div>
                    <div class="form-group col-md-3 {{ $errors->has('Subdireccion_Id') ? 'has-error' : '' }}">
                        <label for="Subdireccion_Id" class="control-label">* Subdirección:</label>
                        @if ($perfil == 'Administrador')
                            <select name="Subdireccion_Id" id="Subdireccion_Id" class="form-control" title="Seleccionar" data-value="{{ $ficha_tecnica ? $ficha_tecnica['Subdireccion_Id'] : old('Subdireccion_Id') }}" data-live-search="true">
                                @foreach($subdirecciones as $subdireccion)
                                    <option value="{{ $subdireccion['Id'] }}">{{ $subdireccion['Nombre_Subdireccion'] }}</option>
                                @endforeach
                            </select>
                        @else
                            <p class="form-control-static">{{ $ficha_tecnica->subdireccion['Nombre_Subdireccion'] }}</p>
                            <input type="hidden" name="Subdireccion_Id" value="{{ $ficha_tecnica['Subdireccion_Id'] }}">
                        @endif
                    </div>
                    <div class="form-group col-md-3 {{ $errors->has('Anio') ? 'has-error' : '' }}">
                        <label for="Anio" class="control-label">* Año:</label>
                        <?php
                            $anio = date('Y');
                        ?>
                        @if ($perfil == 'Administrador')
                            <select name="Anio" id="Anio" class="form-control" title="Seleccionar" data-live-search="true" data-value="{{ $ficha_tecnica ? $ficha_tecnica['Anio'] : old('Anio') }}">
                                @for($i=(+$anio + 1); $i>(+$anio-10); $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        @else
                            <p class="form-control-static">{{ $ficha_tecnica['Anio'] }}</p>
                            <input type="hidden" name="Anio" value="{{ $ficha_tecnica['Anio'] }}">
                        @endif
                    </div>
                    <div class="form-group col-md-3 {{ $errors->has('Fecha_Entrega_Estimada') ? 'has-error' : '' }}">
                        <label for="Fecha_Entrega_Estimada" class="control-label">* Fecha estimada de entrega:</label>
                        @if ($perfil == 'Administrador')
                            <input id="Fecha_Entrega_Estimada" class="form-control " type="text" value="{{ $ficha_tecnica ? $ficha_tecnica['Fecha_Entrega_Estimada'] : old('Fecha_Entrega_Estimada') }}" name="Fecha_Entrega_Estimada" data-role="datepicker">
                        @else
                            <p class="form-control-static">{{ $ficha_tecnica['Fecha_Entrega_Estimada'] }}</p>
                            <input type="hidden" name="Fecha_Entrega_Estimada" value="{{ $ficha_tecnica['Fecha_Entrega_Estimada'] }}">
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('Objeto') ? 'has-error' : '' }}">
                        <label for="Objeto" class="control-label">* Objeto:</label>
                        @if ($perfil == 'Administrador')
                            <textarea class="form-control" placeholder="Objeto" id="Objeto" name="Objeto">{{ $ficha_tecnica ? $ficha_tecnica['Objeto'] : old('Objeto') }}</textarea>
                        @else
                            <p class="form-control-static">{{ $ficha_tecnica['Objeto'] }}</p>
                            <input type="hidden" name="Objeto" value="{{ $ficha_tecnica['Objeto'] }}">
                        @endif
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('Observacion') ? 'has-error' : '' }}">
                        <label for="Observacion" class="control-label">* Observaciones:</label>
                        @if ($perfil == 'Administrador')
                            <textarea class="form-control" placeholder="Observaciones" id="Observacion" name="Observacion">{{ $ficha_tecnica ? $ficha_tecnica['Observacion'] : old('Observacion') }}</textarea>
                        @else
                            <p class="form-control-static">{{ $ficha_tecnica['Observacion'] }}</p>
                            <input type="hidden" name="Observacion" value="{{ $ficha_tecnica['Observacion'] }}">
                        @endif
                    </div>
                    <div class="form-group col-md-3 {{ $errors->has('Fecha_De_Llegada') ? 'has-error' : '' }}">
                        <label for="Fecha_De_Llegada" class="control-label">* Fecha de llegada:</label>
                        @if ($perfil == 'Administrador')
                            <input id="Fecha_De_Llegada" class="form-control " type="text" value="{{ $ficha_tecnica ? $ficha_tecnica['Fecha_De_Llegada'] : old('Fecha_De_Llegada') }}" name="Fecha_De_Llegada" data-role="datepicker">
                        @else
                            <p class="form-control-static">{{ $ficha_tecnica['Fecha_De_Llegada'] }}</p>
                            <input type="hidden" name="Fecha_De_Llegada" value="{{ $ficha_tecnica['Fecha_De_Llegada'] }}">
                        @endif
                    </div>
                    <div class="form-group col-md-3 {{ $errors->has('Hora_De_Llegada') ? 'has-error' : '' }}">
                        <label for="Hora_De_Llegada" class="control-label">* Hora de llegada:</label>
                        @if ($perfil == 'Administrador')
                            <input id="Hora_De_Llegada" class="form-control " type="text" value="{{ $ficha_tecnica ? $ficha_tecnica['Hora_De_Llegada'] : old('Hora_De_Llegada') }}" name="Hora_De_Llegada" data-role="clockpicker">
                        @else
                            <p class="form-control-static">{{ $ficha_tecnica['Hora_De_Llegada'] }}</p>
                            <input type="hidden" name="Hora_De_Llegada" value="{{ $ficha_tecnica['Hora_De_Llegada'] }}">
                        @endif
                    </div>
                    <div class="form-group col-md-3 {{ $errors->has('Presupuesto_Estimado') ? 'has-error' : '' }}">
                        <label for="Presupuesto_Estimado" class="control-label">* Presupuesto estimado:</label>
                        @if ($perfil == 'Administrador')
                            <input type="number" class="form-control" min=0 step=1000 placeholder="Presupuesto estimado" id="Presupuesto_Estimado" name="Presupuesto_Estimado" min="0" value="{{ $ficha_tecnica ? $ficha_tecnica['Presupuesto_Estimado'] : old('Presupuesto_Estimado') }}">
                        @else
                            <p class="form-control-static">{{ $ficha_tecnica['Presupuesto_Estimado'] }}</p>
                            <input type="hidden" name="Presupuesto_Estimado" value="{{ $ficha_tecnica['Presupuesto_Estimado'] }}">
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Presupuesto_Utilizado">Presupuesto utilizado</label>
                        <p class="form-control-static" id="Presupuesto_Utilizado">0</p>
                    </div>
                    <div class="form-group col-md-6 {{ $errors->has('Persona_Id') ? 'has-error' : '' }}" >
                        <label for="Encargado" class="control-label">Ecargado</label>
                        @if ($perfil == 'Administrador')
                            <select class="form-control" name="Persona_Id" id="Persona_Id" title="Seleccionar" data-value="{{ $ficha_tecnica ? $ficha_tecnica['Persona_Id'] : old('Persona_Id') }}">
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario['Id_Persona'] }}">{{ $usuario->toFriendlyString() }}</option>
                                @endforeach
                            </select>
                        @else
                            <p class="form-control-static">{{ $ficha_tecnica->persona->toFriendlyString() }}</p>
                            <input type="hidden" name="Persona_Id" value="{{ $ficha_tecnica['Persona_Id'] }}">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="">% Utilizado</label><br><br>
                        <div class="progress">
                            <div id="progress" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    @if ($perfil == 'Gestor')
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-sm" id="agregar_alcance" type="button">Agregar alcance</button>
                        </div>
                        <div class="col-md-12">
                            <br>
                        </div>
                    @endif
                    <div id="div_alcance_1" class="form-group col-md-4 {{ empty(trim($ficha_tecnica ? $ficha_tecnica['Alcance1'] : old('Alcance1'))) ? 'oculto' : '' }}">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="Alcance1" class="control-label">Alcance N° 1:</label>
                                <input id="Alcance1" class="form-control" type="text" value="{{ $ficha_tecnica ? $ficha_tecnica['Alcance1'] : old('Alcance1') }}" name="Alcance1" data-role="datepicker">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea id="" cols="30" rows="10" class="form-control" placeholder="Observaciones" name="Detalle_Alcance1">{{ $ficha_tecnica ? $ficha_tecnica['Detalle_Alcance1'] : old('Detalle_Alcance1') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div id="div_alcance_2" class="form-group col-md-4 {{ empty(trim($ficha_tecnica ? $ficha_tecnica['Alcance2'] : old('Alcance2'))) ? 'oculto' : '' }}">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="Alcance2" class="control-label">Alcance N° 2:</label>
                                <input id="Alcance2" class="form-control" type="text" value="{{ $ficha_tecnica ? $ficha_tecnica['Alcance2'] : old('Alcance2') }}" name="Alcance2" data-role="datepicker">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea id="" cols="30" rows="10" class="form-control" placeholder="Observaciones" name="Detalle_Alcance2">{{ $ficha_tecnica ? $ficha_tecnica['Detalle_Alcance2'] : old('Detalle_Alcance2') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div id="div_alcance_3" class="form-group col-md-4 {{ empty(trim($ficha_tecnica ? $ficha_tecnica['Alcance3'] : old('Alcance3'))) ? 'oculto' : '' }}">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="Alcance3" class="control-label">Alcance N° 3:</label>
                                <input id="Alcance3" class="form-control" type="text" value="{{ $ficha_tecnica ? $ficha_tecnica['Alcance3'] : old('Alcance3') }}" name="Alcance3" data-role="datepicker">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea id="" cols="30" rows="10" class="form-control" placeholder="Observaciones" name="Detalle_Alcance3">{{ $ficha_tecnica ? $ficha_tecnica['Detalle_Alcance3'] : old('Detalle_Alcance3') }}</textarea>
                            </div>
                        </div>
                    </div>
                    @if ($perfil == 'Gestor')
                        <div class="col-xs-12">
                            <hr>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="control-label">Insumo</label>
                            <input type="text" class="form-control" data-url="{{ url('insumo/buscar') }}" name="apu" aria-label="..." placeholder="Buscar">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="" class="control-label">Insumo Seleccionado</label>
                            <p class="form-control-static" id="apu_seleccionado">No se ha seleccionado ningún APU</p>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="" class="control-label">Cantidad</label>
                            <div class="input-group">
                                <input type="number" class="form-control" min=0 step=1 name="cantidad_apu" placeholder="Cantidad">
                                <span class="input-group-addon" id="addon_unidad">Unidad</span>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="" class="control-label">&nbsp;</label><br>
                            <input type="hidden" name="id_apu" value="0">
                            <button id="agregar-apu" data-url="{{ url('insumo/obtener') }}" type="button" class="btn btn-default">Agregar</button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <br>
                    </div>
                    <div class="col-xs-12">
                        <table id="table_apu" class="table table-min default" data-perfil="{{ $perfil }}">
                            <thead>
                                <tr>
                                    <th width="30px">Cod.</th>
                                    <th width="200px">APU</th>
                                    <th width="60px">Cantidad</th>
                                    <th width="60px">Precio</th>
                                    <th width="60px">Total</th>
                                    <th width="60px">Unidad de m.</th>
                                    <th width="30px" data-priority="2" class="no-sort"></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>

                    <div class="col-md-12">
                        <input type="hidden" name="Id" value="{{ $ficha_tecnica ? $ficha_tecnica['Id'] : 0 }}">
                        <input type="hidden" name="Administrador_Id" value="{{ $ficha_tecnica ? $ficha_tecnica['Administrador_Id'] : $_SESSION['Usuario'][0] }}">
                        <input type="hidden" name="apus" value="{{ $ficha_tecnica ? json_encode($ficha_tecnica->insumos) : old('apus') }}">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ url('/fichaTecnica') }}" class="btn btn-default">Volver</a>
                        @if ($ficha_tecnica)
                            <div class="btn-group">
                                <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Eliminar
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li class="dropdown-header">¿Realmente desea eliminar esta ficha técnica?</li>
                                    <li><a href="{{ url('fichaTecnica/'.$ficha_tecnica['Id'].'/eliminar') }}">Si</a></li>
                                    <li><a href="#">No</a></li>
                                </ul>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    <div class="col-md-12"><br><br><br></div>
                </form>
            </div>
        </div>
    </div>
@stop
