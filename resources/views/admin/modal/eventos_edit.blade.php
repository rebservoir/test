<div class="modal fade" id="eventos_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Editar Evento</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token_evento1" value="{{ csrf_token() }}" id="token_evento1">
				<input type="hidden"  value="" id="evento_id">

				<div class="form-group">
					{!!Form::label('*Titulo:')!!}
					{!!Form::text('title',null,['id'=>'ev_title1','class'=>'input_title','placeholder'=>'Ingresar Titulo'])!!}
				</div>

				<div class="form-group form_date">
					{!!Form::label('*Fecha de Inicio con formato: aaaa-mm-dd:')!!}
					{!! Form::text('start', '', ['id' => 'datepicker_start1','placeholder'=>'aaaa-mm-dd'])!!}
				</div>

				<div class="form-group form_date">
					{!!Form::label('Fecha de Termino con formato: aaaa-mm-dd:')!!}
					{!! Form::text('end', '', ['id' => 'datepicker_end1','placeholder'=>'aaaa-mm-dd'])!!}
				</div>
			</div>
			<div class="modal-footer">
				<div class="requeridos"><p>*Campos requeridos.</p></div>
				<div class="btn_go">
					<div id="btns_delete">
						{!!link_to('#', $title='Actualizar Evento', $attributes = ['id'=>'actualizar_evento', 'class'=>'btn btn-primary'], $secure=null)!!}
						{!!link_to('#', $title='Eliminar', $attributes = ['id'=>'delete_att', 'class'=>'btn btn-danger'], $secure=null)!!}
					</div>
					<div id="btns_confirm" class="btns_confirm"> 
						<p>¿Está seguro de eliminar este evento?</p>
				  		<a href="#" id="cancel" class="btn btn-default">Cancelar</a>
						<a href="#" id="delete" class="btn btn-danger">Ok</a>
					</div>	
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