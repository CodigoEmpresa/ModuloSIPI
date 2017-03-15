@extends('master')                              

@section('content') 
	
<!-- ------------------------------------------------------------------------------------ -->
<center><h3>REGISTRO FICHA TÉCNICA</h3></center>
<input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
<div id="main_persona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}">  
    <div class="content">
        <br>
        <div align="right">
        </div>
        <br><br>
        <div class="row">
        </div>
    </div>
</div>        
@stop