@extends('master')
@section('script')
    @parent
    <script src="{{ asset('public/Js/Items/formulario.js') }}"></script>
    <script src="{{ asset('public/Js/Items/formulario.autocomplete.js') }}"></script>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <br><br>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="" class="control-label">Item <a href="#" id="agregar-item" class="btn-sm btn-link">Agregar</a></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="buscador-items" aria-label="..." placeholder="Buscar">
                                <div class="input-group-btn">
                                    <button id="buscar-item" type="button" class="btn btn-default" data-url="{{ url('item/buscar') }}" name="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-group" id="lista-item" data-url="{{ url('/item') }}"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="" class="control-label">Insumos <a href="#" id="agregar-insumo" class="btn-sm btn-link">Agregar</a></label>
                            <p class="form-control-static">Lista de insumos</p>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-group" id="lista-insumo" data-url="{{ url('/insumo') }}" data-url-assets="{{ asset('public/storage') }}"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="" class="control-label">Cotizaciones <a href="#" id="agregar-cotizacion" class="btn-sm btn-link">Agregar</a></label>
                            <p class="form-control-static">Lista de cotizaciones</p>
                        </div>
                        <div class="col-md-12">
                            <ul class="list-group" id="precio-oficial" style="display:none;">
                                <li class="cotizacion seleccionado list-group-item">
                                    <form id="precio-oficial-form" action="{{ url('insumo/precioOficial') }}" method="post">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label for="" class="control-label">Precio oficial</label>
                                                <input type="number" class="form-control" name="Precio_Oficial">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="" class="control-label">Detalles</label>
                                                <textarea name="Precio_Oficial_Calculo" class="form-control"></textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <input type="hidden" name="Id" value="0">
                                                <input type="hidden" name="_method" value="POST">
                                                <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>
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
                                <label for="" class="control-label">Código</label>
                                <p class="form-control-static" name="Codigo">Automático</p>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="" class="control-label">* Nombre</label>
                                <input type="text" name="Nombre" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="" class="control-label">Descripción</label>
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
                <form id="agregar-insumo-form" action="{{ url('/insumo/crear') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="errores col-md-12" style="display: none;">
                                <div class="alert alert-danger alert-dismissible">
                                    <strong>Solucione los siguientes inconvenientes y vuelva a intentarlo</strong>
                                    <ul>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="" class="control-label">* Código</label>
                                <p class="form-control-static" name="Codigo"></p>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="" class="control-label">* Unidad de medida</label>
                                <input type="text" name="Unidad_De_Medida" class="form-control" data-url="{{ url('/item/unidades') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="" class="control-label">* Nombre</label>
                                <input type="text" name="Nombre" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="" class="control-label">Descripción</label>
                                <textarea name="Descripcion" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="" class="control-label">Precio oficial</label>
                                <p class="form-control-static" name="Precio_Oficial">Sin determinar</p>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="" class="control-label">Precio oficial detalles</label>
                                <p class="form-control-static" name="Precio_Oficial_Calculo">Sin determinar</p>
                            </div>
                            <div class="col-md-12">
                                <img name="Foto_1" data-url="{{ asset('public/storage') }}" src="{{ asset('public/storage/default.jpg') }}" style="height:30px" alt="" class="pointer pull-left img-responsive img-rounded">
                                <img name="Foto_2" data-url="{{ asset('public/storage') }}" src="{{ asset('public/storage/default.jpg') }}" style="height:30px" alt="" class="pointer insumo-img pull-left img-responsive img-rounded">
                                <img name="Foto_3" data-url="{{ asset('public/storage') }}" src="{{ asset('public/storage/default.jpg') }}" style="height:30px" alt="" class="pointer insumo-img pull-left img-responsive img-rounded">
                            </div>
                            <div class="col-md-12">
                                <br>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="Foto_1" class="control-label">Foto 1</label>
                                <input type="file" name="Foto_1">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="Foto_2" class="control-label">Foto 2</label>
                                <input type="file" name="Foto_2">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="Foto_3" class="control-label">Foto 3</label>
                                <input type="file" name="Foto_3">
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
                            <div class="errores col-md-12" style="display: none;">
                                <div class="alert alert-danger alert-dismissible">
                                    <strong>Solucione los siguientes inconvenientes y vuelva a intentarlo</strong>
                                    <ul>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Formulario proveedor</h5>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="" class="control-label">* Nombre</label>
                                <input type="text" name="Nombre" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="" class="control-label">* Ciudad</label>
                                <input type="text" name="Ciudad" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="" class="control-label">* Contacto</label>
                                <input type="text" name="Nombre_Contacto" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="" class="control-label">* Dirección</label>
                                <input type="text" name="Direccion" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="" class="control-label">* Teléfono</label>
                                <input type="text" name="Telefono" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="" class="control-label">* Email</label>
                                <input type="text" name="Email" class="form-control">
                            </div>
                            <div class="col-md-12" style="text-align:right;">
                                <button type="submit" class="btn btn-primary pull-right" style="margin-left:10px;">Guardar</button>
                                <button type="button" class="btn btn-default pull-right" id="cancelar-proveedor">Cancelar</button>
                            </div>
                            <div class="col-md-12">
                                <hr>
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
                                <label for="" class="control-label">* Proveedor</label>
                                <select name="Id_Proveedor" id="Id_Proveedor" class="form-control" title="Seleccionar" data-live-search="true">
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{ $proveedor['Id'] }}">{{ $proveedor['Nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="" class="control-label">&nbsp;</label><br>
                                <a href="#" id="agregar-proveedor" class="btn btn-link">Agregar proveedor</a>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="" class="control-label">&nbsp;</label><br>
                                <a href="#" data-url="{{ url('/proveedor/obtener') }}" id="editar-proveedor" class="btn btn-link">Editar</a>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="" class="control-label">* Precio</label>
                                <input type="number" name="Precio" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="" class="control-label">* Fecha</label>
                                <input type="text" name="Fecha_Actualizacion" data-role="datepicker" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="" class="control-label">Observaciones</label>
                                <textarea name="Observaciones" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="Id" value="0">
                        <input type="hidden" name="Id_Insumo" value="0">
                        <input type="hidden" name="_method" value="POST">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
