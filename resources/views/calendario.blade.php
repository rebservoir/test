@extends('layouts.principal')

	@section('css')
		{!!Html::style('fullcalendar-2.6.0/fullcalendar.css')!!}
		{!!Html::style('fullcalendar-2.6.0/fullcalendar.print.css')!!}
	@stop

@section('nav')
	<a href="/home">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon1">
			</div>
			<p class="">Home</p>
		</div>
	</a>
	<a href="/micuenta">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon2">
			</div>
			<p>Mi Cuenta</p>
		</div>
	</a>
	<a href="/misitio">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon3">
			</div>
			<p>Mi Sitio</p>
		</div>
	</a>
	@foreach($sitios as $sitio)
		@if($sitio->finanzas_active == 1)
			<a href="/finanzas">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
					<div class="nav_ic icon4">
					</div>
					<p>Finanzas</p>
				</div>
			</a>
		@endif
	@endforeach
	<a href="/calendario">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab nav_sel">
			<div class="nav_ic icon5">
			</div>
			<p>Calendario</p>
		</div>
	</a>	
	<a href="/contacto">
		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 nav_tab">
			<div class="nav_ic icon6">
			</div>
			<p>Contacto</p>
		</div>
	</a>
@stop


@section('content')

{{--*/
	$month = array("x","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
	$year_cu = date('Y');
	$year = $year_sel;
	$mes = $mes_sel;
	$day = date('j');
	$fecha = $year . "-" . $mes . "-01";
/*--}}

    <script type="text/javascript">
        var date = <?php echo "'" . $fecha . "'" ?>;
        console.log("fecha:" + date);
        var eventos = [];
        eventos = <?php echo $calendario ?>;
        console.log(eventos);
        window.onload = function(){
        	calendar(date,eventos);	
        }
    </script>

			<div id="main_cont">
				<div class="cont_left col-lg-12">

					<div class="box_header">
						<div class="bx_title bx_100">
							{!!Html::image('img/n_5.png')!!}
							<h1>Calendario</h1>
						</div>
					</div>

					<div id="select_date">
						<p>Seleccionar Año y Mes</p>

							{{--*/ 
								echo "<select id='year_select' name='year_select' class='select_trans'>";
									for ($j = ($year_cu-1); $j < ($year_cu+2); $j++){
										if($j==$year){
											echo "<option value='" . $j . "' selected='selected'>" . $j . "</option>";
										}else{
											echo "<option value='" . $j . "'>" . $j . "</option>";
										}
									}
								echo "</select>"; 
							/*--}}

							{{--*/ 
								echo "<select id='month_select' name='month_select' class='select_trans'>";
									for ($k = 1; $k < 13; $k++){
										if($k==$mes){
											echo "<option value='" . $k . "' selected='selected'>" . $month[$k] . "</option>";
										}else{
											echo "<option value='" . $k . "'>" . $month[$k] . "</option>";
										}
									}
								echo "</select>"; 
							/*--}}

								<button id="btn_cal" value="" class="btn btn-primary">Mostrar</button>
					</div>

						<br><br>
						
					<div id="calendar">
					</div>

				</div>
			</div> <!-- END main_cont -->
@stop


	@section('script')
		{!!Html::script('fullcalendar-2.6.0/lib/moment.min.js')!!}
		{!!Html::script('fullcalendar-2.6.0/fullcalendar.min.js')!!}
		{!!Html::script('fullcalendar-2.6.0/lang-all.js')!!}
		{!!Html::script('js/calendario.js')!!}
	@stop




