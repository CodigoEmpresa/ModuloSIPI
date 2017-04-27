@extends('master')
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
                <form action="{{ url('fichaTecnica/procesar') }}" method="POST">
                    <div class="form-group col-md-3">
                        <label for="Subdireccion" class="control-label">Subdirección:</label>
                        <select name="Subdireccion" id="Subdireccion" class="form-control" title="Seleccionar" data-value="{{ $ficha_tecnica ? $ficha_tecnica['Subdireccion_Id'] : '' }}" data-live-search="true">
                            @foreach($subdirecciones as $subdireccion)
                                <option value="{{ $subdireccion['Id'] }}">{{ $subdireccion['Nombre_Subdireccion'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Anio" class="control-label">Año:</label>
                        <?php
                            $anio = date('Y');
                        ?>
                        <select name="Anio" id="Anio" class="form-control" title="Seleccionar" data-live-search="true" data-value="{{ $ficha_tecnica ? $ficha_tecnica['Anio'] : '' }}">
                            @for($i=(+$anio); $i>(+$anio-50); $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Presupuesto_Estimado" class="control-label">Presupuesto estimado:</label>
                        <input type="number" class="form-control" placeholder="Presupuesto estimado" id="Presupuesto_Estimado" name="Presupuesto_Estimado" min="0" value="{{ $ficha_tecnica ? $ficha_tecnica['Presupuesto_Estimado'] : '' }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Objeto" class="control-label">Objeto:</label>
                        <textarea class="form-control" placeholder="Objeto" id="Objeto" name="Objeto">{{ $ficha_tecnica ? $ficha_tecnica['Objeto'] : '' }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Observaciones" class="control-label">Observaciones:</label>
                        <textarea class="form-control" placeholder="Observaciones" id="Observaciones" name="Observaciones">{{ $ficha_tecnica ? $ficha_tecnica['Observaciones'] : '' }}</textarea>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputEmail" class="control-label">Fecha estimada de entrega:</label>
                        <input id="Fecha_Entrega_Estimada" class="form-control " type="text" value="{{ $ficha_tecnica ? $ficha_tecnica['Fecha_Entrega_Estimada'] : '' }}" name="Fecha_Entrega_Estimada" data-role="datepicker">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Alcance1" class="control-label">Alcance N° 1:</label>
                        <input id="Alcance1" class="form-control" type="text" value="{{ $ficha_tecnica ? $ficha_tecnica['Alcance1'] : '' }}" name="Alcance1" data-role="datepicker">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Alcance2" class="control-label">Alcance N° 2:</label>
                        <input id="Alcance2" class="form-control" type="text" value="{{ $ficha_tecnica ? $ficha_tecnica['Alcance2'] : '' }}" name="Alcance2" data-role="datepicker">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Alcance3" class="control-label">Alcance N° 3:</label>
                        <input id="Alcance3" class="form-control" type="text" value="{{ $ficha_tecnica ? $ficha_tecnica['Alcance3'] : '' }}" name="Alcance3" data-role="datepicker">
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="Id" value="{{ $ficha_tecnica ? $ficha_tecnica['Id'] : 0 }}">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ url('/fichaTecnica') }}" class="btn btn-default">Volver</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xs-12">
            <br>
        </div>
        @if ($ficha_tecnica)
            <div class="col-xs-12">
            <table class="table table-min default">
                <thead>
                    <tr>
                        <th width="30px">Cod.</th>
                        <th>Item</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th class="no-sort"></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        @endif
    </div>
@stop
