<div class="modal fade" id="documento_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Editar Documento</h4>
			</div>

			<div class="modal-body">
				{!! Form::open(['route' => 'documentos.update', 'method'=>'PUT', 'files' => true ])!!}
					<input type="hidden" name="_token_doc" value="{{ csrf_token() }}" id="token_doc">
					<input type="hidden" id="id_doc" name="id_doc">
					<div class="form-group">
						{!!Form::label('*Titulo:')!!}
						{!!Form::text('titulo',null,['id'=>'titulo_edit','class'=>'form-control','placeholder'=>'Ingresar titulo'])!!}
					</div>
					<div class="form-group">
						<p>(Dejar vacio para conservar archivo actual.)</p>
						{!!Form::label('*Archivo:')!!}
						{!!Form::file('path', ['id'=>'path_edit'])!!}
					</div>
			</div>

				<div class="modal-footer">
					<div class="requeridos"><p>*Campos requeridos.</p></div>
					<div class="btn_go">
						<div id="btns_delete_documento">
							{!!Form::submit('Actualizar',['id'=>'actualizar_documento', 'class'=>'btn btn-primary'])!!}
							{!!link_to('#', $title='Eliminar', $attributes = ['id'=>'delete_att_documento', 'class'=>'btn btn-danger'], $secure=null)!!}
						</div>
						<div id="btns_confirm_documento" class="btns_confirm"> 
							<p>¿Está seguro de eliminar este documento?</p>
					  		<a href="#" id="cancel_documento" class="btn btn-default cancel">Cancelar</a>
							<a href="#" id="delete_documento" class="btn btn-danger">Ok</a>
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
