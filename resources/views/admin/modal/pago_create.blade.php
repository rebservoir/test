<div class="modal fade" id="pago_create" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Registro Manual de Pago</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

				<div id="the-basics" class="form-group" style="float:left;">
					{!!Form::label('*Usuario:')!!}
					{!!Form::text('id_user',null,['id'=>'search-input','class'=>'typeahead form-control','placeholder'=>'Ingresar nombre de usuario y seleccionar.'])!!}
				</div>
				<div class="form-group form_date">
					{!!Form::label('*Fecha con formato: aaaa-mm-dd')!!}
					{!! Form::text('date', '',['id' => 'datepicker', 'placeholder'=>'aaaa-mm-dd'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('*Monto:')!!}
					<input type="text" id="amount" class="form-control" value="Cuota de usuario (automatico)" disabled>
				</div>
				<div class="form-group">
					{!!Form::label('*Status:')!!}
					{!!Form::select('status', ['Adeudo', 'Pagado','Pendiente'],null,['id'=>'status'])!!}
				</div>
			</div>
				<div class="modal-footer">
					<div class="requeridos"><p>*Campos requeridos.</p></div>
					<div class="btn_go">
						{!!link_to('#', $title='Registrar pago', $attributes = ['id'=>'registrar_pago', 'class'=>'btn btn-primary'], $secure=null)!!}
					</div>
					<div class="procesando hide">
						<p>Procesando...</p>
					</div>
				</div>
		</div>
	</div>
</div>



					
					