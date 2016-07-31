<h3>Configuración del Sitio</h3>
	<br>

<div id="divSitio">
	@foreach($plan as $plan)
		<table class="table table-bordered">
		    <tbody>
		      <tr>
		      	<td><strong><p>Plan Actual:</p></strong></td>
		        <td>{{$plan->name}} usuarios.</td>
		      </tr>
		      <tr>
		      	<td><p>Usuarios Registrados</p></td>
		      	<td><p>{{$user_count}}</p></td>
		      </tr>
		      <tr>
		      	<td><p>Usuarios Restantes</p></td>
		      	@if(($plan->user_limit - $user_count)==0)
		      		<td><p style="color:red">0 usuarios restantes.<br>Aumentar el plan para obtener más usuarios.</p></td>
		      	@elseif(($plan->user_limit - $user_count)<10)
		      		<td><p style="color:red">{{ $plan->user_limit - $user_count }}</p></td>
		      	@else
					<td>{{ $plan->user_limit - $user_count }}</td>
		      	@endif
		      </tr>
		    </tbody>
		</table>
		<button value='' class='btn btn-primary' data-toggle="modal" data-target="">Cambiar de Plan</button>
	@endforeach

	<br><br><br>

	@foreach($sitios as $sitio)

		<table class="table table-bordered">
		    <tbody>
		      <tr>
		      	<td><strong><p>Nombre del Sitio:</p></strong></td>
		        <td>{{$sitio->name}}</td>
		      </tr>
		      <tr>
		      	<td><strong><p>Imagen principal de home:</p></strong></td>
		        <td><img src="../file/{{$sitio->path}}" class="col-lg-3"></td>
		      </tr>
		    </tbody>
		 </table>
		<button value='{{$sitio->id}}' OnClick='Mostrar_sitio(this);' class='btn btn-primary' data-toggle="modal" data-target="#sitio_edit">Editar Sitio</button>
	@endforeach
</div>




<style type="text/css">

div#divSitio tbody {
    overflow-y: hidden;
    height: auto;
    position: relative;
    border: 1px solid #e2e2e2;
    border-top: none;
}
div#divSitio table {
    height: auto;
}


</style>