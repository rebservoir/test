<h3>Creacion de Teléfonos y Lugares Útiles</h3>
<br>

<div id="msj-success-util" class="alert alert-success alert-dismissible hide" role="alert">
</div>
<div id="msj-fail-util" class="alert alert-danger alert-dismissible hide" role="alert">
</div>
@include('alerts.success')

<button class='btn btn-primary' onclick=""  data-toggle="modal" data-target="#util_create">Registrar Nuevo Telefono/Lugar</button>
<br><br>
<div id="tablaUtiles">
	<table class="table table-striped">
		<thead>
			<th>Concepto</th>
			<th>Editar</th>
		</thead>
		<tbody id="datos">
		@if($utiles->count() === 0)
			<div class="" style="text-align: center;">
				<h4>Aquí aparecerán los Útiles creados.</h4>
			</div>
		@else
			@foreach($utiles as $util)
				<tr>
					<td><p>{{$util->concept}}</p></td>
					<td><button value='{{$util->id}}' OnClick='Mostrar(this);' class='btn btn-primary' data-toggle="modal" data-target="#util_edit">Editar</button></td>
				</tr>
			@endforeach
		@endif
		</tbody>
	</table>
</div>
			