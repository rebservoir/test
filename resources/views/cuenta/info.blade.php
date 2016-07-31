<div id="info_user" class="table-responsive">          
	<table class="table">
		<tbody>
			<tr>
				<td><p>Nombre:</p></td>
				<td><p>{!!Auth::user()->name!!}</p></td>
			</tr>
			<tr>
				<td><p>Email:</p></td>
				<td><p>{!!Auth::user()->email!!}</p></td>
			</tr>
			<tr>
				<td><p>Dirección:</p></td>
				<td><p>{!!Auth::user()->address!!}</p></td>
			</tr>
			<tr>
				<td><p>Telefono:</p></td>
				<td><p>{!!Auth::user()->phone!!}</p></td>
			</tr>
			<tr>
				<td><p>Celular:</p></td>
				<td><p>{!!Auth::user()->celphone!!}</p></td>
			</tr>
		</tbody>
	</table>
</div>

<button value='{!!Auth::user()->id!!}' OnClick='mostrar_info(this);' class='btn btn-primary' data-toggle="modal" data-target="#user_edit">Modificar Información</button>
	<br><br>
<button value='{!!Auth::user()->id!!}' OnClick='asignar_id(this.value);' class='btn btn-primary' data-toggle="modal" data-target="#pass_edit">Modificar Contraseña</button>


