<div class="modal fade" id="documento_create" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Crear Documento</h4>
			</div>

			<div class="modal-body">
				{!! Form::open(array('id' => 'registrar_doc', 'files' => true)) !!}
					<input type="hidden" name="_token_doc" value="{{ csrf_token() }}" id="token_doc">
					<div class="form-group">
						{!!Form::label('*Titulo:')!!}
						{!!Form::text('titulo',null,['id'=>'titulo_doc','class'=>'form-control','placeholder'=>'Ingresar titulo'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('*Archivo:')!!}
						{!!Form::file('path', ['id'=>'path_doc'])!!}
					</div>
			</div>
				<div class="modal-footer">
					<div class="requeridos"><p>*Campos requeridos.</p></div>
					<div class="btn_go">
						{!!Form::submit('Crear Documento',['id'=>'crear_doc', 'class'=>'btn btn-primary'])!!}
					</div>
					<div class="procesando hide">
						<p>Procesando...</p>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>





			
			
					

			