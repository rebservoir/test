<h3>Edición de Noticias</h3>
	<br>

<button class='btn btn-primary'  data-toggle="modal" data-target="#noticia_create">Crear Nueva Noticia</button>
<br><br>
<div id="tablaNoticias">
	<table class="table table-striped">
		<thead>
			<th>Titulo</th>
			<th>Editar</th>
		</thead>
		<tbody id="datos">
		@if($noticias->count() === 0)
			<div class="" style="text-align: center;">
				<h4>Aquí aparecerán las noticias creadas.</h4>
			</div>
		@else
			@foreach($noticias as $noticia)
				<tr>
					<td><a href="noticia_show/{{$noticia->id}}" target="_blank"><p>{{$noticia->titulo}}</p></a></td>
					<td><button value='{{$noticia->id}}' OnClick='Mostrar_noticia(this);' class='btn btn-primary' data-toggle="modal" data-target="#noticia_edit">Editar</button></td>
				</tr>
			@endforeach
		@endif
		</tbody>
	</table>
</div>
			