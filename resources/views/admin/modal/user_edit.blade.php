<div class="modal fade" id="user_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				<input type="hidden" id="id">
				@include('usuario.forms.usr_edit')
				<div class="requeridos"><p>*Campos requeridos.</p></div>
				<br>
			</div>
			
			<div class="modal-footer">
				<div class="btn_go">
					<div id="btns_delete">
						{!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar', 'class'=>'btn btn-primary'], $secure=null)!!}
						{!!link_to('#', $title='Eliminar', $attributes = ['id'=>'delete_att', 'class'=>'btn btn-danger'], $secure=null)!!}
					</div>
					<div id="btns_confirm" class="btns_confirm"> 
						<p>¿Está seguro de eliminar este usuario?</p>
				  		<a href="#" id="cancel" class="btn btn-default">Cancelar</a>
						<a href="#" id="delete" class="btn btn-danger">Ok</a>
					</div>	
				</div>
				<div class="procesando hide">
					<p>Procesando...</p>
				</div>
			</div>
		</div>
	</div>
</div>

