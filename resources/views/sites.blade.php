<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Bill Box</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/fonts/stylesheet.css"/>
		{!!Html::favicon('img/fav.png')!!}
	</head>

	<body>

	@include('alerts.errors')
	@include('alerts.request')

	<!-- -->
	<div  class="">
		<div id="blue">
		</div>

		<div id="sites_box">
			<p><img src="img/logo_tu.jpg" alt="logotipo"></p>
			
			<strong><p>Sitios</p></strong>
			<p>Estos son los sitios en los que estas registrado.<br>Selecciona el sitio al que deseas entrar.</p>
				@foreach($sitios as $sitio)
					<a href="setSite/{{$sitio->id}}">
						<div class="sitio">
							<p>{{$sitio->name}}</p>
							<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
						</div>
					</a>
				@endforeach
		</div>
	</div> <!-- END container-->


		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
	</body>

</html>