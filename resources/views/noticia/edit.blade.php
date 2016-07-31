    @include('alerts.request')

	<h3>Crear noticia</h3>

	<br>

	{!!Form::model($noticia, ['route'=>'noticia.update', 'method'=>'PUT', 'files' => true])!!}

			<div class="form-group">
				{!!Form::label('Titulo:')!!}
				{!!Form::text('titulo',null,['class'=>'form-control','placeholder'=>'Titulo'])!!}
			</div>

			<div class="form-group">
				{!!Form::label('Contenido:')!!}
				{!!Form::textarea('texto',null,['class'=>'form-control','placeholder'=>'Contenido'])!!}
			</div>

			<div class="form-group">
				{!!Form::label('Imagen:')!!}
				{!!Form::file('path')!!}
			</div>

				{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}

	{!!Form::close()!!}


