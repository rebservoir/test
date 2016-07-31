@extends('layouts.principal')

@section('nav')
	<a href="/home">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon1">
			</div>
			<p class="">Home</p>
		</div>
	</a>
	<a href="/micuenta">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon2">
			</div>
			<p>Mi Cuenta</p>
		</div>
	</a>
	<a href="/misitio">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon3">
			</div>
			<p>Mi Sitio</p>
		</div>
	</a>
	@foreach($sitios as $sitio)
		@if($sitio->finanzas_active == 1)
			<a href="/finanzas">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
					<div class="nav_ic icon4">
					</div>
					<p>Finanzas</p>
				</div>
			</a>
		@endif
	@endforeach
	<a href="/calendario">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon5">
			</div>
			<p>Calendario</p>
		</div>
	</a>	
	<a href="/contacto">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon6">
			</div>
			<p>Contacto</p>
		</div>
	</a>
@stop

@section('content')
			<div id="main_cont">
				<div class="">

					<div class="cont_left col-lg-12 ">
						<div class="box_header">
							<img src="../img/noticias.png">
							<h1>Noticias y Avisos</h1>
						</div>

						@include('noticia.noticias')

					</div> <!-- END cont_left -->

				</div>
			</div> <!-- END main_cont -->

@stop