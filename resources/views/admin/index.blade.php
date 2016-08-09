@extends('admin.admin')

@include('admin.nav')

@section('content')
	<div id="slider" class="">
		@foreach($sitios as $sitio)
			<img src="../file/{{$sitio->path}}" class="">
			
			<div id="slider_box">		
			</div>

			<div id="slider_name">
				<p>{{$sitio->name}}</p>
			</div>
		@endforeach
	</div> <!--END Slider -->

	<div id="main_cont">
		<div class="cont_left col-sm-4 col-lg-4 cont_500">
			<div class="row">
				<div class="box_header">
					<div class="bx_title bx_100">
						{!!Html::image('img/morosos.png')!!}
						<h1>Morosos</h1>
					</div>
				</div>		
				<div id="morosos" class="col-xs-12 pull-right">
					<ul>
						@foreach($users as $user)
							<li>{{$user->name}}</li>
						@endforeach		
					</ul>
				</div>
			</div>
		</div>
	
		<div class="cont_right col-xs-12 col-sm-8 col-lg-8 cont_500">
			<div class="row">
				<div class="box_header">
					<div class="bx_title bx_100">
						{!!Html::image('img/noticias.png')!!}
						<h1>Noticias y Avisos</h1>
					</div>
				</div>

			@if($noticias->count() == 0)
				<div class="" style="text-align: center;">
					<h4>Aquí aparecerán las noticias creadas.</h4>
				</div>
			@else
				@foreach($noticias as $noticia)
					<div class="noticia col-xs-12 col-sm-11 col-md-12 col-lg-12">
			    		<div class="col-xs-0 col-sm-1 col-md-1 col-lg-1">
						</div>
						<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
							{!!Html::image('file/'.$noticia->path)!!}
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<h1>{{$noticia->titulo}}</h1>
							<p>{!!substr($noticia->created_at, 0, 10)!!} | {!!(substr($noticia->texto, 0, 100)) . ' ...'!!}<a href="/admin/noticia_show/{{$noticia->id}}">Leer mas...</a></p>
						</div>
					</div>
												
					<div class="row">
						<a class="vmas col-xs-4 col-sm-4 col-lg-3 pull-right" href="../admin/noticias" >Ver mas noticias ></a>
					</div>
				@endforeach
			@endif

			</div> <!-- END row -->
		</div> <!-- END cont_right -->
	</div> <!-- END main_cont -->
@stop


										

