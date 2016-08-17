<div class="modal fade" id="cuota_create" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Registrar Cuotas</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_cuota">
				<input type="hidden" id="id_cuota">
				<div class="form-group">
					{!!Form::label('*Concepto:')!!}
					{!!Form::text('concept',null,['id'=>'concept_cuota','class'=>'form-control','placeholder'=>'Ingresar concepto'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('*Monto:')!!}
					{!!Form::text('monto',null,['id'=>'monto_cuota','class'=>'form-control','placeholder'=>'Ingresar monto'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('Retardo:')!!}
					{!!Form::text('retardo',null,['id'=>'retardo_cuota','class'=>'form-control','placeholder'=>'Ingresar retardo (si existe)'])!!}
				</div>
			</div>

				<div class="modal-footer">
					<div class="requeridos"><p>* Campos requeridos.</p></div>

					<div class="btn_go">
						{!!link_to('#', $title='Registrar', $attributes = ['id'=>'registrar_cuota', 'class'=>'btn btn-primary'], $secure=null)!!}
					</div>
					<div class="procesando hide">
						<p>Procesando...</p>
					</div>
				</div>
		</div>
	</div>
</div>
