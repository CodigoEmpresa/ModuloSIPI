@extends('master')
@section('script')
    @parent
    <script src="{{ asset('public/Js/ficha_tecnica/lista.js') }}"></script>
@stop
@section('content')
    <div class="content">
        <div id="main" class="row" data-url="{{ url('/') }}">
            @if ($status == 'success')
                <div id="alerta" class="col-xs-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Datos actualizados satisfactoriamente.
                    </div>
                </div>
            @endif
            @if(
                $_SESSION['Usuario']['Permisos']['administrar_fichas_tecnicas']
            )
            <div class="col-xs-12">
                <ul class="nav nav-pills">
                    <li class="active"><a href="{{ url('fichaTecnica/crear') }}" name="Enviar" id="Agregar_Ficha">Crear ficha técnica</a></li>
                </ul>
            </div>
            @endif
            <div class="col-md-12">
                <br>
            </div>
            <div class="col-md-12" id="TablaDatos">

            </div>
        </div>
	</div>
@stop
