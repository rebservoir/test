<div class="noticias col-lg-11">
	@foreach($noticias as $noticia)
		<div class="noticia row">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-2">
				{!!Html::image('file/'.$noticia->path)!!}
			</div>
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-10">
				<h1>{{$noticia->titulo}}</h1>
				<p>{!!substr($noticia->created_at, 0, 10)!!} | {!!(substr($noticia->texto, 0, 100)) . ' ...'!!}
					<a href="/admin/noticia_show/{{$noticia->id}}">Leer mas...</a>
				</p>										
			</div>
		</div>
	@endforeach
	{!!$noticias->render()!!}
</div>