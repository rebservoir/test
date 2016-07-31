<div class="modal fade" id="paypal_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Configuración de PayPal</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_paypal">

				<div class="form-group">
					{!!Form::label('*Id Cliente')!!}
					<br>
					{!! Form::text('client_id', '',['id' => 'client_id', 'placeholder'=>'Id Cliente'])!!}
				</div>

				<div class="form-group">
					{!!Form::label('*Clave Secreta')!!}
					<br>
					{!!Form::password('secret',['id'=>'secret','class'=>'form-control','placeholder'=>'Clave Secreta'])!!}
				</div>

			</div>
				<div class="modal-footer">
					<div class="requeridos"><p>*Campos requeridos.</p></div>
					<div class="btn_go">
						{!!link_to('#', $title='Actualizar datos', $attributes = ['id'=>'registrar_paypal', 'class'=>'btn btn-primary'], $secure=null)!!}	
					</div>
					<div class="procesando hide">
						<p>Procesando...</p>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<style type="text/css">

#client_id{
width: 100%;	
}
input[type="password" i]{
width: 100%;	
}


</style>