@extends('admin.admin')

	@section('nav')
		<a href="/admin/home">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon1">
				</div>
				<p>Home</p>
			</div>
		</a>
		<a href="/admin/administracion">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon7">
				</div>
				<p>Administración</p>
			</div>
		</a>
		<a href="/admin/usuarios">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
				<div class="nav_ic icon9">
				</div>
				<p>Usuarios</p>
			</div>
		</a>
		<a href="/admin/contenidos">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
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

					<div class="cont_left col-lg-12">

						<div class="box_header">
							{!!Html::image('img/noticias.png')!!}
							<h1>Noticias y Avisos</h1>
						</div>

						<div class="row">
							@foreach($noti_show as $noticia)
								<div class="noticia_show col-xs-11 col-sm-11 col-md-11 col-lg-11">

										<div class="">
											<h1>{{$noticia->titulo}}</h1>
											<h3>{!!substr($noticia->created_at, 0, 10)!!}</h3>
										</div>

										<div class="">
											{!!Html::image('file/'.$noticia->path)!!}
											<p>{{$noticia->texto}}</p>
										</div>

								</div>					
							@endforeach
						</div>
									<br>
								<a href="/admin/noticias" class="noticia_show_a">Regresar a noticias</a>
									<br>
					</div> <!-- END cont_left -->
				</div>
			</div> <!-- END main_cont -->

@stop