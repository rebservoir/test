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
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
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
<div class="cont_left cont_600 col-lg-3">
	<div class="box_header">
		<div class="bx_title bx_80">
			{!!Html::image('img/n_3.png')!!}
			<h1>Mi Sitio</h1>
		</div>
		<div class="bx_20">
			<button class="burger">
				<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
			</button>
		</div>
	</div>
	<div id="admin_nav" class="nav_menu">
		<ul id="ul_interna">
			<li id="int_l1" class="left_sel"><p>Teléfonos y Sitios Útiles</p></li>
			<li id="int_l2"><p>Políticas Internas</p></li>
			<!--
			<li id="int_l3"><p>Lost & Found</p></li>
			<li id="int_l4"><p>Encuestas</p></li>
			<li id="int_l5"><p>Venta, Donación y Alquiler</p></li>
			-->
		</ul>
	</div>
</div>

<div class="cont_right col-lg-8">
	<div id="int_div1" class="int_div_sel">
		<div class="box_header">
			<p>Mi Sitio > Teléfonos y Sitios Útiles</p>
		</div>
						
		<div class="cont_in_r">
			@include('sitio/utiles')
		</div>
	</div>

	<div id="int_div2" class="int_div">
		<div class="box_header">
			<p>Mi Sitio > Políticas Internas</p>
		</div>
						
		<div class="cont_in_r">
			@include('sitio/politicas')
		</div>
	</div>
<!--
	<div id="int_div3" class="int_div">
		<div class="box_header">
			<p>Mi Sitio > Lost & Found</p>
		</div>

		<div class="cont_in_r">
		</div>
	</div>

	<div id="int_div4" class="int_div">
		<div class="box_header">
			<p>Mi Sitio > Encuestas</p>
		</div>
						
		<div class="cont_in_r">
		</div>
	</div>

	<div id="int_div5" class="int_div">
		<div class="box_header">
			<p>Mi Sitio > Venta, Donación y Alquiler</p>
		</div>
						
		<div class="cont_in_r">
		</div>
	</div>
-->
</div> <!-- END cont_right -->
@stop