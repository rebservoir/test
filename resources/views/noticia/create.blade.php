
	<h3>Crear noticia</h3>

	<br>

	{!!Form::open(['route'=>'noticia.store', 'method'=>'POST'])!!}

			<div class="form-group">
				{!!Form::label('*Titulo:')!!}
				{!!Form::text('titulo',null,['class'=>'form-control','placeholder'=>'Titulo'])!!}
			</div>

			<div class="form-group">
				{!!Form::label('*Contenido:')!!}
				{!!Form::textarea('texto',null,['class'=>'form-control','placeholder'=>'Contenido'])!!}
			</div>

				{!!Form::submit('Crear Noticia',['class'=>'btn btn-primary'])!!}

	{!!Form::close()!!}


	