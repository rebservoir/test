<div class="modal fade" id="egresos_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Editar Egresos</h4>
			</div>

			<div class="modal-body">
			{!! Form::open(['route' => 'egresos.update', 'method'=>'PUT', 'files' => true ])!!}
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_eg1">
				<input type="hidden" id="id_egresos" name="id_egresos">

				<div class="form-group">
					{!!Form::label('*Concepto:')!!}
					{!!Form::text('concept',null,['id'=>'concept_eg','class'=>'form-control','placeholder'=>'Ingresar Concepto'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Archivo:')!!}
					{!!Form::file('path', ['id'=>'path_eg'])!!}
				</div>
				<div class="form-group form_date">
					{!!Form::label('*Fecha con formato: aaaa-mm-dd')!!}
					{!! Form::text('date', '', ['id' => 'datepicker_eg_edit','placeholder'=>'aaaa-mm-dd'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('*Cantidad:')!!}
					{!!Form::text('amount',null,['id'=>'amount_eg','class'=>'form-control','placeholder'=>'Ingresar Cantidad'])!!}
				</div>
			</div>
				<div class="modal-footer">
					<div class="requeridos"><p>*Campos requeridos.</p></div>
					<div class="btn_go">
						<div id="btns_delete_egresos">
							{!!Form::submit('Actualizar',['id'=>'actualizar_egresos', 'class'=>'btn btn-primary'])!!}
							{!!link_to('#', $title='Eliminar', $attributes = ['id'=>'delete_att_egresos', 'class'=>'btn btn-danger'], $secure=null)!!}
						</div>
						<div id="btns_confirm_egresos" class="btns_confirm"> 
							<p>¿Está seguro de eliminar este egreso?</p>
					  		<a href="#" id="cancel_egresos" class="btn btn-default cancel">Cancelar</a>
							<a href="#" id="delete_egresos" class="btn btn-danger">Ok</a>
						</div>
					</div>
					<div class="procesando hide">
						<p>Procesando...</p>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

