@extends('admin.admin')

	@include('alerts.success')
	@include('admin.modal.user_create')
	@include('admin.modal.user_edit')
	@include('admin.modal.detalle_pagos')
	@include('admin.modal.pass_edit')

	@include('admin.nav')

	@section('content')

		@include('alerts.update')
		@include('alerts.msg')

		<div id="main_cont">
			
			<div class="cont_left col-lg-12">

				<div class="box_header">	
					<div class="bx_title bx_100">
						{!!Html::image('img/n_9.png')!!}
						<h1>Usuarios</h1>
					</div>
				</div>

				<div id="divSitio">
					@foreach($plan as $plan)
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><p>Usuarios Registrados</p></th>
								<th><p>Limite de Usuarios</p></th>
								<th><p>Usuarios Restantes</p></th>
							</tr>
						</thead>

					    <tbody>
					      <tr>
					      	<td><p>{{$user_count}}</p></td>
					      	<td>{{$plan->user_limit}}</td>
							@if(($plan->user_limit - $user_count)==0)
					      		<td><p style="color:red">0 usuarios restantes.<br>Aumentar el plan para obtener más usuarios.</p></td>
					      	@elseif(($plan->user_limit - $user_count)<10)
					      		<td><p style="color:red">{{ $plan->user_limit - $user_count }}</p></td>
					      	@else
								<td>{{ $plan->user_limit - $user_count }}</td>
					      	@endif
					      </tr>
					    </tbody>
					</table>
					<button value='' class='btn btn-primary' data-toggle="modal" data-target="">Cambiar de Plan</button>
					@endforeach
					<br><br>
				</div>

				<div style="float: left;">
					<button value='' OnClick='clearModals()' class='reg_user btn btn-primary' data-toggle="modal" data-target="#user_create">Registrar un Nuevo Usuario</button>
					<br>
					<div id="the-basics" class="form-group">
						<input type="text" id="search-input" class="typeahead form-control" placeholder="Buscar..." >	
					</div>
				</div>
		
				<div id="search_result">
				</div>

				<br><br>
<!--
			{!! Form::open(array('id' => 'load_data', 'files' => true)) !!}
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_load">
				<div class="form-group">
					{!!Form::label('Archivo:')!!}
					{!!Form::file('file', ['id'=>'file'])!!}
				</div>
					{!!Form::submit('Cargar',['id'=>'load_data', 'class'=>'btn btn-primary'])!!}
			{!! Form::close() !!}
-->

				<div id="tablaUsuarios">
					@include('usuario.usuarios')
				</div>
			
			</div> <!-- END cont_left -->

		</div> <!-- END main_cont -->

	@stop

	@section('script')
		{!!Html::script('js/typeahead.js/bloodhound.js')!!}
		{!!Html::script('js/typeahead.js/typeahead.bundle.js')!!}
		{!!Html::script('js/typeahead.js/typeahead.jquery.js')!!}
		{!!Html::script('js/user.js')!!}
	@stop




<style type="text/css">

div#divSitio{
    width: 400px;
    margin: 0 auto;
    text-align: center;
    float: right;
}
div#divSitio thead th{
    text-align: center;
}
div#divSitio tbody {
    overflow-y: hidden;
    height: auto;
    position: relative;
    border: 1px solid #e2e2e2;
    border-top: none;
    text-align: center;
}
div#divSitio table {
    height: auto;
}


</style>