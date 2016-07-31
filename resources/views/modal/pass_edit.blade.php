<div class="modal fade" id="pass_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Modificar Contraseña</h4>
			</div>

			<div class="modal-body">
                <br>

                <input type="hidden" name="_token_pass" value="{{ csrf_token() }}" id="token_pass">
                <input type="hidden" id="id_pass" name="id_pass">

                {!!Form::label('*Contraseña actual:')!!}
                <br>
                {!!Form::password('pass', array('id' => 'current_pass' ,'class' => 'form-control', 'placeholder'=>'Contraseña actual'))!!}
                <br>
                {!!Form::label('*Nueva contraseña:')!!}
                <br>
                {!!Form::password('new_pass', array('id' => 'new_pass' ,'class' => 'form-control', 'placeholder'=>'Nueva contraseña'))!!}
                <br>
                {!!Form::label('*Confirmar nueva contraseña:')!!}
                <br>
                {!!Form::password('new_pass_2', array('id' => 'new_pass_2' ,'class' => 'form-control', 'placeholder'=>'Confirmar nueva contraseña'))!!}
                <br>
			</div>

                <div class="modal-footer">
                    <div class="requeridos"><p>*Campos requeridos.</p></div>
                    <div class="btn_go">
                        {!!link_to('#', $title='Modificar contraseña', $attributes = ['id'=>'pass_modify', 'class'=>'btn btn-primary'], $secure=null)!!}
                    </div>
                    <div class="procesando hide">
                        <p>Procesando...</p>
                    </div>
                </div>
			
		</div>
	</div>
</div>
