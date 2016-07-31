@extends('admin.admin')
@section('content')

	<div id="btns_delete"> 
		{!!Form::model($user, ['route'=> ['usuario.update', $user->id], 'method'=>'PUT'])!!}
			@include('usuario.forms.usr')
				{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
		{!!Form::close()!!}

		{!!Form::open(['route'=> ['usuario.destroy', $user->id], 'method'=>'DELETE'])!!}
			{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
		{!!Form::close()!!}
	</div>
		
	<div id="btns_confirm"> 
		<p style="margin: 10px 0px 6px 0px;font-size: 16px;">Esta seguro de eliminar este usuario?</p>
  		<a href="#" id="actualizar" class="btn btn-default">Cancelar</a>
		<a href="#" id="eliminar" class="btn btn-danger">Ok</a>
	</div>

@stop

