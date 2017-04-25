@extends('master', ['full_width' => true, 'no_header' => true])
@section('script')
    @parent
    <script src="{{ asset('public/Js/Items/formulario.js') }}"></script>
    <script src="{{ asset('public/Js/Items/formulario.autocomplete.js') }}"></script>
@stop
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <br><br>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">APU <a href="#" id="agregar-item" class="btn-sm btn-link">Agregar</a></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="buscador-items" aria-label="..." placeholder="Buscar">
                                <div class="input-group-btn">
                                    <button id="buscar-item" type="button" class="btn btn-default" data-url="{{ url('item/buscar') }}" name="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-group" id="mantener-item"></ul>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-group" id="lista-item" data-url="{{ url('/item') }}"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Insumos <a href="#" id="agregar-insumo" class="btn-sm btn-link">Agregar</a></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="buscador-insumos" aria-label="..." placeholder="Buscar">
                                <div class="input-group-btn">
                                    <button id="buscar-insumo" type="button" class="btn btn-default" data-url="{{ url('insumo/buscar') }}"  name="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-group" id="mantener-insumo"></ul>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-group" id="lista-insumo" data-url="{{ url('/insumo') }}"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Cotizaciones <a href="#" id="agregar-cotizacion" class="btn-sm btn-link">Agregar</a></label>
                            <p class="form-control-static">Lista de cotizaciones</p>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-group" id="lista-cotizaciones" data-url="{{ url('/cotizacion') }}"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-agregar-item" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">Item</h3>
                </div>
                <form id="agregar-item-form" action="{{ url('/item/crear') }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="errores col-md-12" style="display: none;">
                                <div class="alert alert-danger alert-dismissible">
                                    <strong>Solucione los siguientes inconvenientes y vuelva a intentarlo</strong>
                                    <ul>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Código</label>
                                <input type="text" name="Codigo" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Unidad de medida</label>
                                <input type="text" name="Unidad_De_Medida" class="form-control" data-url="{{ url('/item/unidades') }}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Nombre</label>
                                <input type="text" name="Nombre" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Descripción</label>
                                <textarea name="Descripcion" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="Id" value="0">
                        <input type="hidden" name="_method" value="POST">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-agregar-insumo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">Insumo</h3>
                </div>
                <form id="agregar-insumo-form" action="{{ url('/insumo/crear') }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="errores col-md-12" style="display: none;">
                                <div class="alert alert-danger alert-dismissible">
                                    <strong>Solucione los siguientes inconvenientes y vuelva a intentarlo</strong>
                                    <ul>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Código</label>
                                <input type="text" name="Codigo" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Unidad de medida</label>
                                <input type="text" name="Unidad_De_Medida" class="form-control" data-url="{{ url('/item/unidades') }}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Nombre</label>
                                <input type="text" name="Nombre" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Descripción</label>
                                <textarea name="Descripcion" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Grupo</label> <br>
                                <label class="radio-inline">
                                    <input type="radio" name="Grupo" value="Materiales"> Materiales
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="Grupo" value="Maquinaria"> Maquinaria
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="Grupo" value="Mano de obra"> Mano de obra
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="Grupo" value="Transporte"> Transporte
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="Grupo" value="Otro"> Otro
                                </label>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Precio</label>
                                <input type="text" name="Precio" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="Id" value="0">
                        <input type="hidden" name="_method" value="POST">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-agregar-cotizacion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel">Cotización</h3>
                </div>
                <form id="agregar-proveedor-form" style="display:none;" method="post" action="{{ url('proveedor/crear') }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="errores col-md-12" style="display: none;">
                                        <div class="alert alert-danger alert-dismissible">
                                            <strong>Solucione los siguientes inconvenientes y vuelva a intentarlo</strong>
                                            <ul>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style="background-color: #efefef;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Nuevo proveedor</h4>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" name="Nombre" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Ciudad</label>
                                            <input type="text" name="Ciudad" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Contacto</label>
                                            <input type="text" name="Nombre_Contacto" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Dirección</label>
                                            <input type="text" name="Direccion" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Teléfono</label>
                                            <input type="text" name="Telefono" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Email</label>
                                            <input type="text" name="Email" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-danger btn-sm" id="cancelar-proveedor">Cancelar</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                        </div>
                                        <div class="col-md-12">
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="agregar-cotizacion-form" action="{{ url('/cotizacion/crear') }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="errores col-md-12" style="display: none;">
                                <div class="alert alert-danger alert-dismissible">
                                    <strong>Solucione los siguientes inconvenientes y vuelva a intentarlo</strong>
                                    <ul>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Proveedor</label>
                                <select name="Id_Proveedor" id="Id_Proveedor" class="form-control" title="Seleccionar" data-live-search="true">
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{ $proveedor['Id'] }}">{{ $proveedor['Nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">&nbsp;</label><br>
                                <a href="#" id="agregar-proveedor" class="btn btn-link">Agregar proveedor</a>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Precio</label>
                                <input type="number" name="Precio" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Fecha</label>
                                <input type="text" name="Fecha_Actualizacion" data-role="datepicker" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Precio oficial</label> <br>
                                <label class="radio-inline">
                                    <input type="radio" name="Precio_Oficial" value="1"> Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="Precio_Oficial" value="0"> No
                                </label>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Observaciones</label>
                                <textarea name="Observaciones" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Precio oficial calculo</label>
                                <textarea name="Precio_Calculo" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="Id" value="0">
                        <input type="hidden" name="Id_Item" value="0">
                        <input type="hidden" name="_method" value="POST">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
