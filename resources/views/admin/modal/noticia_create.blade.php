<div class="modal fade" id="noticia_create" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Crear Noticia</h4>
			</div>

			<div class="modal-body">
				{!! Form::open(array('id' => 'registrar_noticia', 'files' => true)) !!}
					<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_noti_2">
					<input type="hidden" id="id_noti_2">
					<div class="form-group">
						{!!Form::label('*Titulo:')!!}
						{!!Form::text('titulo',null,['id'=>'titulo','class'=>'form-control','placeholder'=>'Titulo'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('*Contenido:')!!}
						{!!Form::textarea('texto',null,['id'=>'contenido','class'=>'form-control','placeholder'=>'Contenido'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('*Imagen:')!!}
						{!!Form::file('path', ['id'=>'path'])!!}
					</div>
			</div>
			<div class="modal-footer">
				<div class="requeridos"><p>*Campos requeridos.</p></div>
				<div class="btn_go">
					{!!Form::submit('Crear Noticia',['id'=>'registrar_noticia', 'class'=>'btn btn-primary'])!!}
				</div>
				<div class="procesando hide">
					<p>Procesando...</p>
				</div>
			</div>
				{!! Form::close() !!}
		</div>
	</div>
</div>






