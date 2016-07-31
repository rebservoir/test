@section('nav')
		<a href="{{ URL::to('/admin/home')}}">
			@if($current=='home')
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
			@else
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			@endif
				<div class="nav_ic icon1">
				</div>
				<p>Home</p>
			</div>
		</a>
		<a href="{{ URL::to('/admin/administracion')}}">
			@if($current=='admin')
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
			@else
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			@endif
				<div class="nav_ic icon7">
				</div>
				<p>Administración</p>
			</div>
		</a>
		<a href="{{ URL::to('/admin/usuarios')}}">
			@if($current=='usuarios')
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
			@else
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			@endif
				<div class="nav_ic icon9">
				</div>
				<p>Usuarios</p>
			</div>
		</a>
		<a href="{{ URL::to('/admin/contenidos')}}">
			@if($current=='contenidos')
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
			@else
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			@endif
				<div class="nav_ic icon8">
				</div>
				<p>Contenidos</p>
			</div>
		</a>
		<a href="{{ URL::to('/admin/finanzas')}}">
			@if($current=='finanzas')
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
			@else
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			@endif
				<div class="nav_ic icon4">
				</div>
				<p>Finanzas</p>
			</div>
		</a>
		<a href="{{ URL::to('/admin/calendario')}}">
			@if($current=='calendario')
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
			@else
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			@endif
				<div class="nav_ic icon5">
				</div>
				<p>Calendario</p>
			</div>
		</a>
@stop