<h3>Documentos</h3>

<div id="msj-success-doc" class="alert alert-success alert-dismissible hide" role="alert">
</div>
<div id="msj-fail-doc" class="alert alert-danger alert-dismissible hide" role="alert">
</div>

<button class='btn btn-primary' data-toggle="modal" data-target="#documento_create">Crear Documento</button>

	<br><br>

<div id="divDocs">
	<table class="table table-striped">
		<thead>
			<th>Titulo</th>
			<th>Editar</th>
		</thead>
		<tbody>
		@if($documentos->count() === 0)
			<div class="" style="text-align: center;">
				<h4>Aquí aparecerán los documentos creados.</h4>
			</div>
		@else
			<input type="hidden" name="_token_doc1" value="{{ csrf_token() }}" id="token_doc1">
			@foreach($documentos as $doc)
				<tr>      	
					<td><p><a href="/file/{{$doc->path}}" target="_blank">{{$doc->titulo}}</a></p></td>
					<td><button value='{{$doc->id}}' OnClick='mostrar_doc(this);' class='btn btn-primary' data-toggle="modal" data-target="#documento_edit" data_value="{{$doc->id}}">Editar</button></td>
				</tr>
			@endforeach
		@endif
		</tbody>
	</table>
</div>