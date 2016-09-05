		<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
		<input type="hidden" id="id1">
		<div class="form-group">
			{!!Form::label('*Email:')!!}
			{!!Form::email('email',null,['id'=>'email1','class'=>'form-control','placeholder'=>'Ingresar Email'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('*Nombre:')!!}
			{!!Form::text('name',null,['id'=>'name1','class'=>'form-control','placeholder'=>'Ingresar nombre de usuario'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Dirección:')!!}
			{!!Form::text('address',null,['id'=>'address1','class'=>'form-control','placeholder'=>'Ingresar direccion'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Telefono:')!!}
			{!!Form::text('phone',null,['id'=>'phone1','class'=>'form-control','placeholder'=>'Ingresar direccion'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Celular:')!!}
			{!!Form::text('celphone',null,['id'=>'cel1','class'=>'form-control','placeholder'=>'Ingresar direccion'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Campo adicional 1:')!!}
			{!!Form::text('field1',null,['id'=>'field1_1','class'=>'form-control','placeholder'=>'Campo adicional 1'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('Campo adicional 2:')!!}
			{!!Form::text('field2',null,['id'=>'field2_1','class'=>'form-control','placeholder'=>'Campo adicional 2'])!!}
		</div>
			<div class="type_msg"></div>
		<div class="form-group">
			{!!Form::label('*Cuota:')!!}
			{!!Form::select('type', $tipos , null ,['id'=>'type1', 'placeholder'=>'Seleccionar opción', 'required' ])!!}
		</div>
			<div class="role_msg"></div>
		<div class="form-group">
			{!!Form::label('*Rol:')!!}
			{!!Form::select('role', ['Residente', 'Administrador'],null,['id'=>'role1'])!!}
		</div>

		<div id="changePass" class="hide">
			<button value='{!!Auth::user()->id!!}' OnClick='asignar_id(this.value);' class='btn btn-primary'>Modificar Contraseña</button>
			<br><br>
		</div>
