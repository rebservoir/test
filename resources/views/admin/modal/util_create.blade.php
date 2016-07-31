<div class="modal fade" id="util_create" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Registrar Telefonos/Lugares Utiles</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token1">
				<div class="form-group">
					{!!Form::label('*Concepto:')!!}
					{!!Form::text('concept',null,['id'=>'concept1','class'=>'form-control','placeholder'=>'Ingresar concepto'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Dirección:')!!}
					{!!Form::text('address',null,['id'=>'address1','class'=>'form-control','placeholder'=>'Ingresar direccion'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Telefono:')!!}
					{!!Form::text('phone_num',null,['id'=>'phone_num1','class'=>'form-control','placeholder'=>'Ingresar Telefono'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('URL:')!!}
					{!!Form::text('url',null,['id'=>'url1','class'=>'form-control','placeholder'=>'Ingresar URL'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('*Categoria:')!!}
					{!!Form::select('category', ['Emergencias', 'Mi Sitio', 'Tintorerias', 'Taxi', 'Farmacias', 'Gruas', 'Ferreterias', 'Otros'],null,['id'=>'category1'])!!}
				</div>
			</div>
				<div class="modal-footer">
					<div class="requeridos"><p>*Campos requeridos.</p></div>
					<div class="btn_go">
						{!!link_to('#', $title='Registrar', $attributes = ['id'=>'registrar', 'class'=>'btn btn-primary'], $secure=null)!!}
					</div>
					<div class="procesando hide">
						<p>Procesando...</p>
					</div>
				</div>
		</div>
	</div>
</div>




