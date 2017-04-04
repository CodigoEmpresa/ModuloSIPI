@extends('master')
@section('script')
    @parent
    <script src="{{ asset('public/Js/FichaTecnica/detalles.js') }}"></script>
@stop
@section('content')
    <div class="row">
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
        <div class="col-xs-12">
            <hr>
        </div>
        <div class="col-xs-12"><br></div>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Items</label>
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="..." placeholder="Buscar">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" name="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="#" id="agregar-item" class="btn btn-sm btn-link">Agregar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Insumos</label>
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="..." placeholder="Buscar">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" name="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="" class="btn btn-sm btn-link">Agregar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Cotizaciones</label>
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="..." placeholder="Buscar">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" name="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="" class="btn btn-sm btn-link">Agregar</a>
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
                <form id="agregar-item-form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Código</label>
                                <input type="text" name="Codigo" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Unidad de medida</label>
                                <input type="text" name="Unidad_De_Medida" class="form-control">
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
                        <input type="hidden" name="Id_Item" value="0">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
