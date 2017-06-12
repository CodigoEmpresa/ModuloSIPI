@extends('master')
@section('script')
    @parent
    <script src="{{ asset('public/Js/buscador/formulario.js') }}"></script>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <br><br>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <form id="form-buscador" action="{{ url('/buscador') }}" method="POST">
                            <div class="col-md-12 form-group">
                                <label for="" class="control-label">Buscar</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="term" aria-label="...">
                                    <div class="input-group-btn">
                                        <input type="hidden" name="_method" value="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-default" name="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <ul class="list-group">
                        @if ($insumos)
                            @foreach($insumos as $insumo)
                                <li class="list-group-item">
                                    <h4 class="list-group-item-heading">
                                        {{ $insumo->item->getCode().'-'.$insumo->Id }} | {{ $insumo->Nombre }} <small>{{ $insumo->item->Nombre }}</small>
                                        <br>
                                        <br>
                                        <a data-toggle="image" data-rel="Foto_1" href="{{ asset('public/storage/'.($insumo->Foto_1 ? $insumo->Foto_1 : 'default.jpg')) }}" class=""><img height="20px"; src="{{ asset('public/storage/'.($insumo->Foto_1 ? $insumo->Foto_1 : 'default.jpg')) }}" alt="" /></a>
                                        <a data-toggle="image" data-rel="Foto_2" href="{{ asset('public/storage/'.($insumo->Foto_2 ? $insumo->Foto_2 : 'default.jpg')) }}" class="$insumo-img"><img height="20px"; src="{{ asset('public/storage/'.($insumo->Foto_2 ? $insumo->Foto_2 : 'default.jpg')) }}" alt="" /></a>
                                        <a data-toggle="image" data-rel="Foto_3" href="{{ asset('public/storage/'.($insumo->Foto_3 ? $insumo->Foto_3 : 'default.jpg')) }}" class="$insumo-img"><img height="20px"; src="{{ asset('public/storage/'.($insumo->Foto_3 ? $insumo->Foto_3 : 'default.jpg')) }}" alt="" /></a>
                                        <br>
                                        <br>
                                    </h4>
                                    <p class="list-group-item-text">
                                        <strong>Descripción: </strong>
                                        <br>
                                        {{ $insumo->Descripcion }}
                                        <br>
                                        <br>

                                        <strong>Precio oficial:</strong>
                                        <br>
                                        ${!! $insumo->Precio_Oficial ? $insumo->Precio_Oficial.' <small>'.$insumo->Precio_Oficial_Calculo.'</small>' : 'Sin determinar'  !!}
                                        <br>
                                        <br>

                                        <a href="#" class="ver-mas btn btn-default btn-xs">ver más</a>
                                        <br>
                                        <br>
                                    </p>
                                    <div class="mas" style="display: none">
                                        <table class="table table-min default" style="width: 100% !important;">
                                            <thead>
                                                <tr>
                                                    <?php $i = 0 ?>
                                                    <th class="all" style="width:30px;">#</th>
                                                    <th class="all" style="width:150px;">Proveedor</th>
                                                    <th class="none">Nombre</th>
                                                    <th class="none">Ciudad</th>
                                                    <th class="none">Direccion</th>
                                                    <th class="none">Teléfono</th>
                                                    <th class="none">Email</th>
                                                    <th class="all" style="width:100px;">Fecha</th>
                                                    <th>Observaciones</th>
                                                    <th class="all" style="width:100px;">Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($insumo->cotizaciones as $cotizacion)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td>{{ $cotizacion->proveedor['Nombre'] }}</td>
                                                        <td>{{ $cotizacion->proveedor['Nombre_Contacto'] }}</td>
                                                        <td>{{ $cotizacion->proveedor['Ciudad'] }}</td>
                                                        <td>{{ $cotizacion->proveedor['Direccion'] }}</td>
                                                        <td>{{ $cotizacion->proveedor['Telefono'] }}</td>
                                                        <td>{{ $cotizacion->proveedor['Email'] }}</td>
                                                        <td>{{ $cotizacion->Fecha_Actualizacion }}</td>
                                                        <td>{{ $cotizacion->Observaciones }}</td>
                                                        <td align="right">{{ $cotizacion->Precio }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
