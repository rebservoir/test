<div class="modal fade" id="eventos_create" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Crear Evento</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token_evento" value="{{ csrf_token() }}" id="token_evento">

				<div class="form-group">
					{!!Form::label('*Titulo:')!!}
					{!!Form::text('title',null,['id'=>'ev_title','class'=>'input_title','placeholder'=>'Ingresar Titulo'])!!}
				</div>

				<div class="form-group form_date">
					{!!Form::label('*Fecha de Inicio (aaaa-mm-dd):')!!}
					{!! Form::text('start', '', ['id' => 'datepicker_start','placeholder'=>'aaaa-mm-dd'])!!}
				</div>

				<div class="form-group form_date">
					{!!Form::label('Fecha de Termino (aaaa-mm-dd):')!!}
					{!! Form::text('end', '', ['id' => 'datepicker_end','placeholder'=>'aaaa-mm-dd'])!!}
				</div>
			</div>
			<div class="modal-footer">
				<div class="requeridos"><p>*Campos requeridos.</p></div>
				<div class="btn_go">
					{!!link_to('#', $title='Crear Evento', $attributes = ['id'=>'registrar_evento', 'class'=>'btn btn-primary'], $secure=null)!!}
				</div>
				<div class="procesando hide">
					<p>Procesando...</p>
				</div>
			</div>
		</div>
	</div>
</div>


<style type="text/css">
	
	.input_title{
		 width: 100%;
	}
	
</style>