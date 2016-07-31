<div class="modal fade" id="util_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Actualizar Telefonos/Lugares Utiles</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				<input type="hidden" id="id">
				<div class="form-group">
					{!!Form::label('*Concepto:')!!}
					{!!Form::text('concept',null,['id'=>'concept','class'=>'form-control','placeholder'=>'Ingresar concepto'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Dirección:')!!}
					{!!Form::text('address',null,['id'=>'address','class'=>'form-control','placeholder'=>'Ingresar direccion'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Telefono:')!!}
					{!!Form::text('phone_num',null,['id'=>'phone_num','class'=>'form-control','placeholder'=>'Ingresar Telefono'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('URL:')!!}
					{!!Form::text('url',null,['id'=>'url','class'=>'form-control','placeholder'=>'Ingresar URL'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('*Categoria:')!!}
					{!!Form::select('category', ['Emergencias', 'Mi Sitio', 'Tintorerias', 'Taxi', 'Farmacias', 'Gruas', 'Ferreterias', 'Otros'],null,['id'=>'category'])!!}
				</div>
			</div>
				<div class="modal-footer">
					<div class="requeridos"><p>*Campos requeridos.</p></div>
					<div class="btn_go">
						<div id="btns_delete_util">
							{!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar_util', 'class'=>'btn btn-primary'], $secure=null)!!}
							{!!link_to('#', $title='Eliminar', $attributes = ['id'=>'delete_att_util', 'class'=>'btn btn-danger'], $secure=null)!!}
						</div>
						<div id="btns_confirm_util" class="btns_confirm"> 
							<p>¿Está seguro de eliminar este dato?</p>
					  		<a href="#" id="cancel_util" class="btn btn-default cancel">Cancelar</a>
							<a href="#" id="delete_util" class="btn btn-danger">Ok</a>
						</div>
					</div>
					<div class="procesando hide">
						<p>Procesando...</p>
					</div>
				</div>

		</div>
	</div>
</div>




