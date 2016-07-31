<div class="modal fade" id="user_create" role="dialog">

	<div class="modal-dialog" role="document">
		<div class="modal-content">


			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Registrar Usuario</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				<input type="hidden" id="id">
				@include('usuario.forms.usr_create')
				<div class="requeridos"><p>*Campos requeridos.</p></div>
				<br>
			</div>
			
			<div class="modal-footer">
				<div class="btn_go">
					{!!link_to('#', $title='Registrar', $attributes = ['id'=>'registrar', 'class'=>'btn btn-primary'], $secure=null)!!}	
				</div>
				<div class="btn_reactivar_2 hide">
					{!!link_to('#', $title='Reactivar', $attributes = ['id'=>'reactivar_2', 'class'=>'btn btn-primary'], $secure=null)!!}	
				</div>
				<div class="btn_asignar_2 hide">
					{!!link_to('#', $title='Asignar', $attributes = ['id'=>'asignar_2', 'class'=>'btn btn-primary'], $secure=null)!!}	
				</div>
				<div class="procesando hide">
					<p>Procesando...</p>
				</div>
			</div>
		</div>
	</div>
</div>
