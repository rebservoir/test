<div class="modal fade" id="pago_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Registro Manual de Pago</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_pago">
				<input type="hidden" name="user_name" value="" id="hidden_id">
				<input type="hidden" name="hidden_id_user" value="" id="hidden_id_user">
				<input type="hidden" id="id_pago">
				<div id="the-basics" class="form-group" style="float:left;">
					{!!Form::label('*Usuario:')!!}
					{!!Form::text('id_user',null,['id'=>'search-input2','class'=>'typeahead form-control','placeholder'=>'Ingresar nombre de usuario y seleccionar.'])!!}
				</div>
				<div class="form-group form_date">
					{!!Form::label('*Fecha con formato: aaaa-mm-dd')!!}
					{!! Form::text('date', '', ['id' => 'datepicker_pago','placeholder'=>'aaaa-mm-dd'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('*Monto:')!!}
					{!!Form::text('amount',null,['id'=>'amount_pago','class'=>'form-control','placeholder'=>'Ingresar Cantidad','disabled' => 'disabled'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('*Status:')!!}
					{!!Form::select('status', ['2'=>'Pendiente','1'=>'Pagado','0'=>'Adeudo'],null,['id'=>'status_pago'])!!}


				</div>
			</div>
				<div class="modal-footer">
					<div class="requeridos"><p>*Campos requeridos.</p></div>
					<div class="btn_go">
						<div id="btns_delete_pago">
							{!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar_pago', 'class'=>'btn btn-primary'], $secure=null)!!}
							{!!link_to('#', $title='Eliminar', $attributes = ['id'=>'delete_att_pago', 'class'=>'btn btn-danger'], $secure=null)!!}
						</div>
						<div id="btns_confirm_pago" class="btns_confirm"> 
							<p>¿Está seguro de eliminar este pago?</p>
					  		<a href="#" id="cancel_pago" class="btn btn-default cancel">Cancelar</a>
							<a href="#" id="delete_pago" class="btn btn-danger">Ok</a>
						</div>
					</div>
					<div class="procesando hide">
						<p>Procesando...</p>
					</div>
				</div>
		</div>
	</div>
</div>

