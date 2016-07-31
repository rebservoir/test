@extends('admin.admin')

	@section('nav')
		<a href="home">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon1">
				</div>
				<p>Home</p>
			</div>
		</a>
		<a href="administracion">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon7">
				</div>
				<p>Administración</p>
			</div>
		</a>
		<a href="usuarios">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2  nav_tab">
				<div class="nav_ic icon9">
				</div>
				<p>Usuarios</p>
			</div>
		</a>
		<a href="contenidos">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2  nav_tab">
				<div class="nav_ic icon8">
				</div>
				<p>Contenidos</p>
			</div>
		</a>
		<a href="/admin/finanzas">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon4">
				</div>
				<p>Finanzas</p>
			</div>
		</a>
		<a href="/admin/calendario">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon5">
				</div>
				<p>Calendario</p>
			</div>
		</a>
	@stop

@section('content')
<div id="main_cont">
	<div class="">
		<div class="cont_left col-lg-12 ">
			<div class="box_header">
				{!!Html::image('img/noticias.png')!!}
				<h1>Noticias y Avisos</h1>
				@if(Session::has('success'))
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('success')}}
					</div>
				@endif
			</div>

			@include('admin.noticia.noticias')
			
		</div> <!-- END cont_left -->
	</div>
</div> <!-- END main_cont -->
@stop