	@extends('admin.admin')

	@include('admin.modal.eventos_create')
	@include('admin.modal.eventos_edit')

	@section('css')
		{!!Html::style('fullcalendar-2.6.0/fullcalendar.css')!!}
		{!!Html::style('fullcalendar-2.6.0/fullcalendar.print.css')!!}
		{!!Html::style('css/jquery-ui.min.css')!!}
	@stop

	@include('admin.nav')

@section('content')

{{--*/
	$month = array("x","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
	$year_cu = date('Y');
	$year = $year_sel;
	$mes = intval($mes_sel);
	$day = date('j');
	if(!($mes>10)){
		$fecha = $year . "-0" . $mes . "-01";
    }else{
    	$fecha = $year . "-" . $mes . "-01";
	}
/*--}}

			@include('alerts.update')
			@include('alerts.msg')

			<div id="main_cont">
				<div class="cont_left col-lg-12">

					<div class="box_header">
						<div class="bx_title bx_100">
							{!!Html::image('img/n_5.png')!!}
							<h1>Calendario</h1>
						</div>
					</div>

					<div id="msj-fail" class="alert alert-danger alert-dismissible hide" role="alert">
						<p>Volver a intentar.</p>
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

							<div id="btns_cal">
								<button id="btn_cal_admin" value="" class="btn btn-primary">Mostrar</button>
								<button id="btn_add_event" value="" class="btn btn-primary" data-toggle="modal" data-target="#eventos_create">Crear Evento</button>
							</div>

					</div>

						<br><br>
						
					<div id="calendar">
					</div>

						<br><br>

					<div id="tablaEventos">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Titulo</th>
									<th>Inicio</th>
									<th>Fin</th>
									<th>Editar</th>	
								</tr>
							</thead>
							<tbody>
								@foreach($calendario as $cale)
									{{--*/ 	$date_ev = explode("-", $cale->start); /*--}}
									@if(($date_ev[0] == $year_sel)&&($date_ev[1] == $mes_sel))
										<tr>
											<td>
												<p>{{$cale->title}}</p>
											</td>
											<td>
												<p>{{$cale->start}}</p>
											</td>
											<td>
												<p>{{$cale->end}}</p>
											</td>
											<td>
												<button value='{{$cale->id}}' onclick="mostrar_evento(this);" class='btn btn-primary' data-toggle="modal" data-target="#eventos_edit">Editar</button>
											</td>
										</tr>
									@endif
								@endforeach	
							</tbody>
						</table>
					</div>

				</div>
			</div> <!-- END main_cont -->
@stop


	@section('script')
		{!!Html::script('js/calendario.js')!!}
		{!!Html::script('fullcalendar-2.6.0/lib/moment.min.js')!!}
		{!!Html::script('fullcalendar-2.6.0/fullcalendar.min.js')!!}
		{!!Html::script('fullcalendar-2.6.0/lang-all.js')!!}
	@stop



    <script type="text/javascript">
        var date = <?php echo "'" . $fecha . "'" ?>;
        var eventos = [];
        eventos = <?php echo $calendario ?>;
        window.onload = function(){
        	calendar(date,eventos);	
        }
    </script>

<style type="text/css">

#tablaEventos tr{
	width: 100%;
	display: inline-table;  
    table-layout: fixed;
}

#tablaEventos table{
 	height:300px; 
}
#tablaEventos tbody{
  	overflow-y: scroll;
  	height: 260px;
  	position: absolute;
    border: 1px solid #e2e2e2;
    border-top: none;
}

</style>