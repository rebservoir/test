<div class="modal fade" id="noticia_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Modificar Noticia</h4>
			</div>

			<div class="modal-body">
				{!! Form::open(['route' => 'noticia.update', 'method'=>'PUT', 'files' => true ])!!}
					<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_noti_1">
					<input type="hidden" id="id_noti_1" name="id_noti_1">
					<div class="form-group">
						{!!Form::label('*Titulo:')!!}
						{!!Form::text('titulo',null,['id'=>'titulo1','class'=>'form-control','placeholder'=>'Titulo'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('*Contenido:')!!}
						{!!Form::textarea('texto',null,['id'=>'contenido1','class'=>'form-control','placeholder'=>'Contenido'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('*Imagen:')!!}
						<p>(Dejar vacio para conservar imagen actual.)</p>
						{!!Form::file('path', ['id'=>'path1'])!!}
					</div>
			</div>
			
				<div class="modal-footer">
					<div class="requeridos"><p>*Campos requeridos.</p></div>
					<div class="btn_go">
						<div id="btns_delete_noticia">
							{!!Form::submit('Modificar Noticia',['class'=>'btn btn-primary'])!!}
							{!!link_to('#', $title='Eliminar', $attributes = ['id'=>'delete_att_noticia', 'class'=>'btn btn-danger'], $secure=null)!!}
						</div>
						<div id="btns_confirm_noticia" class="btns_confirm"> 
							<p>¿Está seguro de eliminar esta noticia?</p>
					  		<a href="#" id="cancel_noticia" class="btn btn-default">Cancelar</a>
							<a href="#" id="delete_noticia" class="btn btn-danger">Ok</a>
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