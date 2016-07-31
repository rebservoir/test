<div class="modal fade" id="sitio_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Modificar Sitio</h4>
			</div>
			
			<div class="modal-body">
				{!! Form::open(['route' => ['sitio.update' , $id_site ], 'method'=>'PUT', 'files' => true ])!!}
					<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_sitio_1">
					<input type="hidden" value="" id="path_sitio">
					<div class="form-group">
						{!!Form::label('Nombre del Sitio:')!!}
						{!!Form::text('name',null,['id'=>'name_frac','class'=>'form-control','placeholder'=>'Nombre del Sitio'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('Imagen:')!!}
						<p>(Dejar vacio para conservar imagen actual.)</p>
						{!!Form::file('path', ['id'=>'path'])!!}
					</div>
			</div>
				<div class="modal-footer">
					<div class="btn_go">
						{!!Form::submit('Modificar datos',['class'=>'btn btn-primary'])!!}
					</div>
					<div class="procesando hide">
						<p>Procesando...</p>
					</div>
				</div>
				{!! Form::close() !!}
		</div>
	</div>
</div>