<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Bill Box</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		
		{!!Html::favicon('../img/fav.png')!!}
		{!!Html::style('css/bootstrap.min.css')!!}
		{!!Html::style('css/style.css')!!}
		{!!Html::style('css/media_query.css')!!}
		{!!Html::style('css/fonts/stylesheet.css')!!}
		@yield('css')

	</head>

	<body>

	<div class="">
		<div id="head" class="">
			<div class="container">
				
				<a href="home">
					<div id="logo" class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-left">
						{!!Html::image('img/logo_tu.jpg')!!}
					</div>
				</a>
				
				<div id="mensaje">
					<div class="pull-left">
						@foreach($sitios as $sitio)
							<p>{{$sitio->name}}</p>
						@endforeach
						<p>|</p>
						<p>{!!Auth::user()->name!!}</p>
					</div>
					<div class="pull-right">
						<div class="dropdown">
							<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
						    	<span class="glyphicon glyphicon-chevron-down"></span>
							</button>
						    <ul class="dropdown-menu">
						    	@if($sites>1)
									<li><a href="/sitios"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>Cambiar de Sitio</a></li>
						    	@endif
								<li><a href="/logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>Cerrar Sesión</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>			
		</div>

		<nav id="navigation" class="navbar navbar-default">
		    <div class="container bg_blue">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		    </div>
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse no_pd" id="bs-example-navbar-collapse-1">
		      		<ul class="nav navbar-nav col-sm-12 col-md-12 col-lg-12 no_pd">
						@yield('nav')
			  		</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>	
	</div> <!--END container-fluid -->

			<div id="container" class="container">
				<div id="main_cont">
					@yield('content')
				</div>

				<div class="publicidad col-sm-12 col-lg-12 row">
					{!!Html::image('img/banner.png')!!}
				</div>

			</div> <!-- END container-->
		
		<div id="footer" class="container-fluid">
		</div>

		{!!Html::script('js/jquery-1.11.3.min.js')!!}
		{!!Html::script('js/bootstrap.min.js')!!}
		{!!Html::script('js/main.js')!!}
		{!!Html::script('js/sch.js')!!}
		@yield('script')
	</body>

</html>