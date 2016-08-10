@section('nav')
	<a href="{{ URL::to('/home')}}">
		@if($current=='home')
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
		@else
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
		@endif
			<div class="nav_ic icon1">
			</div>
			<p class="">Home</p>
		</div>
	</a>
	<a href="{{ URL::to('/micuenta')}}">
		@if($current=='cuenta')
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
		@else
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
		@endif
			<div class="nav_ic icon2">
			</div>
			<p>Mi Cuenta</p>
		</div>
	</a>
	<a href="{{ URL::to('/misitio')}}">
		@if($current=='misitio')
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
		@else
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
		@endif
			<div class="nav_ic icon3">
			</div>
			<p>Mi Sitio</p>
		</div>
	</a>
	@foreach($sitios as $sitio)
		@if($sitio->finanzas_active == 1)
			<a href="{{ URL::to('/finanzas')}}">
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
		@endif
	@endforeach
	<a href="{{ URL::to('/calendario')}}">
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
	<a href="{{ URL::to('/contacto')}}">
		@if($current=='contacto')
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
		@else
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
		@endif
			<div class="nav_ic icon6">
			</div>
			<p>Contacto</p>
		</div>
	</a>
@stop