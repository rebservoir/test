@extends('admin.admin')

@include('admin.nav')

@section('content')

{{--*/ 
$month = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
/*--}}

{{--*/ 
	$year = date('Y');
	$mes = date('n');
	$day = date('j');
	$total_egresos=0;
	$total_ingresos=0;
	$year = $year_sel;
	$mes = $mes_sel;
/*--}}

	<div id="main_cont">
		<div class="cont_left col-lg-12">
	
			<div class="box_header">
				<div class="bx_title bx_100">
					{!!Html::image('img/n_4.png')!!}
					<h1>Finanzas</h1>
				</div>
			</div>

				<div id="select_date_tr">
					<p>Seleccionar Año y Mes</p>
						{{--*/ 
								echo "<select id='year_select' name='year_select' class='select_trans'>";

								for ($j = 2014; $j < 2017; $j++){
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
										echo "<option value='" . $k . "' selected='selected'>" . $month[$k-1] . "</option>";
									}else{
										echo "<option value='" . $k . "'>" . $month[$k-1] . "</option>";
									}
								}
								echo "</select>"; 
						/*--}}

						<button id="btn_select_admin" value='' class='btn btn-primary'>Mostrar</button>
				</div>

				<br><br>

	{{--*/ $pagos_num=0; $pagos_p=0; $pagos_a=0; /*--}}
		@foreach($pagos as $pago)
			{{--*/ 	$date_pago = explode("-", $pago->date);/*--}}
			@if(($date_pago[1] == $mes) && ($date_pago[0] == $year))
				{{--*/ $pagos_num++;/*--}}					
					@if($pago->status == 1)
						{{--*/ $pagos_p++;/*--}}
					@else
						{{--*/ $pagos_a++;/*--}}
					@endif
			@endif
		@endforeach

	{{--*/ 
		$mes_ant=$mes_sel - 1;
		$year_ant=0;
		$egr=0;

		if($mes_ant==0){
			$mes_ant=12;
			$year_ant=$year_sel-1;
		}else{
			$mes_ant=$mes_sel-1;
			$year_ant=$year_sel;
		}
		$saldo_anterior=0;
	/*--}}


		@foreach($egresos as $egreso)
			{{--*/ $date = explode("-", $egreso->date) /*--}}
				@if(($date[1] == $mes_ant) && ($date[0] == $year_ant))
						{{--*/ $egr = $egr + $egreso->amount; /*--}}
				@endif
		@endforeach


		@foreach($egresos as $egreso)
			{{--*/ $date = explode("-", $egreso->date) /*--}}
				@if(($date[1] == $mes) && ($date[0] == $year))
					{{--*/ $total_egresos .= $egreso->amount; /*--}}
				@endif
		@endforeach




		
    <script type="text/javascript">
        var paga = <?php echo $pagos_p ?>;
        var deuda = <?php echo $pagos_a ?>;
        window.onload = function(){
        	loadChart(paga,deuda);	
        }
    </script>

    <div id="cont_table">
		<table class="table cifras table-condensed">
			<thead>
				<th class="egremes">
					<h4>{{$month[$mes_sel-1]}} {{$year_sel}}</h4>
				</th>
			</thead>



		@foreach($pagos as $pago)
			{{--*/ $date = explode("-", $pago->fecha_pago) /*--}}
				@if(($date[1] == $mes) && ($date[0] == $year))
					@if($pago->status == 1)
						{{--*/ $total_ingresos = $total_ingresos + $pago->amount; /*--}}
					@endif
				@endif
		@endforeach

		@foreach($saldos as $saldo)
			{{--*/ $fecha_saldo = explode("-", $saldo->date); /*--}}
				@if(($fecha_saldo[1] == $mes_ant) && ($fecha_saldo[0] == $year_ant))
					{{--*/ $saldo_anterior .= $saldo->saldo; /*--}}
				@endif
		@endforeach

			<tbody>								
				<tr>
					<td class="ingreso">
						<h3>{{'$ '. number_format($total_ingresos, 2) }}</h3>
						<h4>Ingresos del Mes</h4>
					</td>
				</tr>
				<tr> 
						{{--*/ $money = number_format($total_egresos, 2) /*--}}
					<td class="cifras2 egresos">
						<h3>{{'-$ '.$money}}</h3>
						<h4>Total de Egresos en el Mes</h4>
					</td>
				</tr>
			</tbody>
		</table>

			<br>

		<div id='chart_div' class='chart'>
			<p style="margin-top: 185px;text-align: center;">Cargando grafica...</p>
		</div>

		<table class="table table-striped table-condensed">
			<thead>
				<th class="egremes">
					<h4>Tabla de Egresos</h4>
				</th>
			</thead>

			<tbody id="tbody_egresos">
				<tr>
					<th>Fecha</th>
					<th>Descripción</th>
					<th>Monto</th>
					<th>Archivo</th>
				</tr>

			@foreach($egresos as $egreso)
				{{--*/ $date = explode("-", $egreso->date) /*--}}
					@if(($date[1] == $mes) && ($date[0] == $year))
						<tr>
								{{--*/ $date = explode("-", $egreso->date) /*--}}
								{{--*/ $money = number_format($egreso->amount, 2) /*--}}
							<td><p>{{$egreso->date}}</p></td>
							<td><p>{{$egreso->concept}}</p></td>
							<td><p>{{'$ '.$money}}</p></td>
															
						@if($egreso->path=="")
							<td><p>Sin archivo</p></td>
						@else
							<td><a href='/file/{{$egreso->path}}'  target="_blank">Ver archivo</a></td>
						@endif
							</tr>
					@endif
			@endforeach
			 </tbody>
		</table>

				<br>

		<table class="table saldos table-striped table-condensed">

			<thead>
				<th class="egremes">
					<h4>Saldos</h4>
				</th>
			</thead>

			<tbody>
				<tr>
					<td class="">
						<h3>{{'$ '. number_format($saldo_anterior,2)}}</h3>
						<h4>Saldo Mes Anterior</h4>
					</td>
				</tr>
				<tr>
					<td class="">
						{{--*/ $saldo_mes = $total_ingresos - $total_egresos; /*--}}
						<h3>{{'$ '. number_format($saldo_mes,2) }}</h3>
						<h4>Saldo del mes</h4>
					</td>
				</tr>
				<tr>
						{{--*/ $saldo_total = $saldo_anterior + $saldo_mes; /*--}}
					<td class="total">	
						<h3>{{'$ '. number_format($saldo_total,2) }}</h3>
						<h4>Saldo total</h4>
					</td>
				</tr>
			</tbody>
		</table>

			</div> <!-- END cont_table -->
		</div>	  
	</div> <!-- END main_cont -->


@stop

@section('script')
	{!!Html::script('js/trans.js')!!}
	{!!Html::script('https://www.gstatic.com/charts/loader.js')!!}
@stop


<script type="text/javascript">
	window.onload = function() {
		var $mes = document.getElementById('year_select');
	};
	
</script>



