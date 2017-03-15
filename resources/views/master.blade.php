<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		@section('style')
				<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
				<link rel="stylesheet" href="{{ asset('public/components/jquery-ui/themes/base/jquery-ui.css') }}" media="screen">    
				<link rel="stylesheet" href="{{ asset('public/Css/bootstrap.css') }}" media="screen">    
				<link rel="stylesheet" href="{{ asset('public/components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" media="screen">
				<link rel="stylesheet" href="{{ asset('public/components/datatables.net-bs/css/dataTables.bootstrap.css') }}" media="screen">
				<link rel="stylesheet" href="{{ asset('public/components/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" media="screen">
				<link rel="stylesheet" href="{{ asset('public/components/highcharts/css/highcharts.css') }}" media="screen">
				<link rel="stylesheet" href="{{ asset('public/components/loaders.css/loaders.min.css') }}" media="screen">
				<link rel="stylesheet" href="{{ asset('public/Css/main.css') }}" media="screen">    
		@show

		@section('script')
				<script src="{{ asset('public/components/jquery/jquery.js') }}"></script>
				<script src="{{ asset('public/components/jquery-ui/jquery-ui.js') }}"></script>
				<script src="{{ asset('public/components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
				<script src="{{ asset('public/components/moment/moment.js') }}"></script>
				<script src="{{ asset('public/components/datatables.net/js/jquery.dataTables.js') }}"></script>
				<script src="{{ asset('public/components/datatables.net-bs/js/dataTables.bootstrap.js') }}"></script>
				<script src="{{ asset('public/components/datatables.net-responsive/js/dataTables.responsive.js') }}"></script>
				<script src="{{ asset('public/components/highcharts/js/highcharts.js') }}"></script>
				<script src="{{ asset('public/components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
				<script src="{{ asset('public/Js/main.js') }}"></script>
		@show
		<title>SIPI</title>
	</head>
	<body>
		<!-- Menu Módulo -->
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a href="{{ url('/welcome') }}" class="navbar-brand">SIM</a>
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse" id="navbar-main">
					<ul class="nav navbar-nav">
						@if ($_SESSION['Usuario']['Permisos']['administrar_usuarios'])
							<li><a href="{{ url('/personas') }}">Administración</a></li>
						@endif
					</ul>
					<ul class="nav navbar-nav">
						<li>
		                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Ficha Técnica <span class="caret"></span></a>
		                <ul class="dropdown-menu" aria-labelledby="themes">		                  
		                      <li><a href="{{ URL::to( 'registroFT') }}">Registro Ficha Técnica</a></li>		                  
		                      <li><a href="{{ URL::to( 'ediciónFT') }}">Edición Ficha Técnica</a></li>		                  
		                </ul>
		              </li>
		              </ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="http://www.idrd.gov.co/sitio/idrd/" target="_blank">I.D.R.D</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $_SESSION['Usuario']['Persona']['Primer_Apellido'].' '.$_SESSION['Usuario']['Persona']['Primer_Nombre'] }}<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li>
									<a href="{{ url('personas/'.$_SESSION['Usuario'][0].'/editar') }}">Editar</a>
								</li>
								<li>
									<a href="{{ url('logout') }}">Cerrar sesión</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- FIN Menu Módulo -->
			
		<!-- Contenedor información módulo -->
		</br></br>
		<div class="container">
			<div class="page-header" id="banner">
				<div class="row">
					<div class="col-lg-8 col-md-7 col-sm-6">
						<h1>Módulo</h1>
						<p class="lead"><h4>Descripción</h4></p>
					</div>
					<div class="col-lg-4 col-md-5 col-sm-6">
						 <div align="right"> 
								<img src="{{ asset('public/Img/IDRD.JPG') }}" width="50%" heigth="40%"/>
						 </div>                    
					</div>
					<div class="col-sm-12">
						<p class="text-primary">{{ $seccion ? $seccion : '' }}</p>
					</div>
				</div>
			</div>        
		</div>
		<!-- FIN Contenedor información módulo -->

		<!-- Contenedor panel principal -->
		<div class="container">
			@yield('content')
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<br><br><br>
				</div>
			</div>
		</div> 
		<div class="ajaxloader">
			<div class="ball-scale-multiple"><div></div><div></div><div></div></div>
			<span>PROCESANDO</span>
		</div>
		<!-- FIN Contenedor panel principal -->
	</body>
</html>





