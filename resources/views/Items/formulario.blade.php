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
        <div class="col-md-11 col-md-offset-1">
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Items <a href="#" id="agregar-item" class="btn-sm btn-link">Agregar</a></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="buscador-items" aria-label="..." placeholder="Buscar">
                                <div class="input-group-btn">
                                    <button id="buscar-item" type="button" class="btn btn-default" data-url="{{ url('item/buscar') }}" name="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="mantener-item">

                        </div>
                        <div class="col-md-12" id="lista-item" data-url="{{ url('/item') }}">

                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-md-offset-1">
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
                        <div class="col-md-12" id="mantener-insumo">

                        </div>
                        <div class="col-md-12" id="lista-insumo" data-url="{{ url('/insumo') }}">

                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Cotizaciones <a href="#" id="agregar-cotizacion" class="btn-sm btn-link">Agregar</a></label>
                            <p class="form-control-static">Lista de cotizaciones</p>
                        </div>
                        <div class="col-md-12" id="lista-cotizaciones" data-url="{{ url('/cotizaciones') }}">

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
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                <label for="">Discripción</label>
                                <textarea name="Descripcion" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="Id" value="0">
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                <label for="">Discripción</label>
                                <textarea name="Descripcion" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="Id" value="0">
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
                <form id="nuevo-proveedor" style="display:none;" action="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="errores col-md-12" style="display: none;">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Solucione los siguientes inconvenientes y vuelva a intentarlo</strong>
                                        <ul>

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12" style="background-color: #efefef;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Nuevo proveedor</h4>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" name="Nombre" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="">Contacto</label>
                                            <input type="text" name="Nombre_Contacto" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="">Direccion</label>
                                            <input type="text" name="Direccion" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="">Teléfono</label>
                                            <input type="text" name="Telefono" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="">Email</label>
                                            <input type="text" name="Email" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary btn-sm" id="guardar-proveedor">Guardar</button>
                                            <button type="button" class="btn btn-danger btn-sm" id="cancelar-proveedor">Cancelar</button>
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
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Solucione los siguientes inconvenientes y vuelva a intentarlo</strong>
                                    <ul>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Proveedor</label>
                                <select name="Id_Proveedor" id="Id_Proveedor" class="form-control" title="Seleccionar">

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
                                <input type="text" name="Precio" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Fecha</label>
                                <input type="text" name="Fecha_Actualizacion" data-role="datepicker" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Precio oficial</label> <br>
                                <label class="radio-inline">
                                    <input type="radio" name="Precio_Oficial" id="Precio_Oficial_Si" value="1"> Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="Precio_Oficial" id="Precio_Oficial_No" value="0"> No
                                </label>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Precio oficial calculo</label>
                                <textarea name="Precio_Calculo" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="Id" value="0">
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
