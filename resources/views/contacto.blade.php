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
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
			<div class="nav_ic icon6">
			</div>
			<p>Contacto</p>
		</div>
	</a>
@stop

@section('content')

				<div id="main_cont">
				<div class="">

					<div class="cont_left col-lg-12">

						<div class="box_header">
							<div class="bx_title bx_100">
								{!!Html::image('img/n_6.png')!!}
								<h1>Contacto</h1>
							</div>
						</div>

							<div id="msj-success" class="alert alert-success alert-dismissible hide" role="alert">
	  							<p>Su mensaje ha sido enviado,Gracias. </p>
							</div>

							<div id="msj-fail" class="alert alert-danger alert-dismissible hide" role="alert">
							  	<p>Lo sentimos, el mensaje no ha sido enviado. Volver a intentar.</p>
							</div>	
						

						<div class="contact-form">
							<input type="hidden" name="token_contact" value="{{ csrf_token() }}" id="token_contact">
							<input type="hidden" name="name" value="{{ Auth::user()->name }}" id="name">
							<input type="hidden" name="email" value="{{ Auth::user()->email }}" id="email">
								    <div class="">
										{!!Form::label('Nombre:')!!}
										<p>{!!Auth::user()->name!!}</p>
									</div>
									<div class="">
										{!!Form::label('Email:')!!}
										<p>{!!Auth::user()->email!!}</p>
									</div>
									<div class="">
										{!!Form::label('Mensaje:')!!}
										{!!Form::textarea('msg',null,['id'=>'msg','class'=>'typeahead form-control','placeholder'=>'Mensaje'])!!}
									</div>
									{!!link_to('#', $title='Enviar', $attributes = ['id'=>'enviar_contacto', 'class'=>'btn btn-primary'], $secure=null)!!}
						</div> 
					</div>
				</div>
			</div> <!-- END main_cont -->
@stop


<style type="text/css">
.contact-form{

	width: 395px;
	margin-left: 65px;
}
</style>