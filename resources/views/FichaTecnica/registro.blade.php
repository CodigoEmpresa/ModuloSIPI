@extends('master')
@section('script')
    @parent
    <script src="{{ asset('public/Js/FichaTecnica/registroFT.js') }}"></script>
@stop
@section('content')
    <div class="content">
        <div id="main" class="row" data-url="{{ url('/') }}">
            <div class="col-xs-12">
                <ul class="nav nav-pills">
                    <li class="active"><a href="{{ url('fichaTecnica/crear') }}" name="Enviar" id="Agregar_Ficha">Crear ficha técnica</a></li>
                </ul>
            </div>
            <div class="col-md-12">
                <br>
            </div>
            <div class="col-md-12" id="TablaDatos">

            </div>
        </div>
	</div>
@stop
