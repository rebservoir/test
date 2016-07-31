
	@if( count($tipos) === 0 )

		<div><p>Crear Cuotas en <a href="{{ URL::to('/admin/administracion')}}">Administración</a> antes de generar usuarios.</p></div>

	@else

	<div class="form-group">
			{!!Form::label('*Nombre:')!!}
			{!!Form::text('name',null,['id'=>'name','class'=>'form-control','placeholder'=>'Ingresar nombre de usuario'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('*Email:')!!}
			{!!Form::email('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'Ingresar Email'])!!}
		</div>
			<div id="email_msg">
			</div>
			<button type="button" id="react_btn" class="btn btn-primary hidden" value="" style="margin: -10px 0px 10px 0px;">Proceder a reactivar</button>
			<button type="button" id="asignar_btn" class="btn btn-primary hidden" value="" style="margin: -10px 0px 10px 0px;">Proceder a asignar</button>
		<div class="form-group">
			{!!Form::label('Dirección:')!!}
			{!!Form::text('address',null,['id'=>'address','class'=>'form-control','placeholder'=>'Ingresar direccion'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Telefono:')!!}
			{!!Form::text('phone',null,['id'=>'phone','class'=>'form-control','placeholder'=>'Ingresar direccion'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Celular:')!!}
			{!!Form::text('celphone',null,['id'=>'cel','class'=>'form-control','placeholder'=>'Ingresar direccion'])!!}
		</div>
			<div class="type_msg"></div>
		<div class="form-group">
			{!!Form::label('*Cuota:')!!}
			{!!Form::select('type', $tipos ,null,['id'=>'type', 'placeholder'=>'Seleccionar opción', 'required' ])!!}
		</div>
			<div class="role_msg"></div>
		<div class="form-group">
			{!!Form::label('*Rol:')!!}
			{!!Form::select('role', ['Residente', 'Administrador'],null,['id'=>'role'])!!}
		</div>



	@endif


		




	
		