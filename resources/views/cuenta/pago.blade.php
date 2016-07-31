
{{--*/ 
$month = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");  
$total = 0;
$monto = $cuota;
/*--}}

<h3>Saldo vencido</h3>

<table class='table table-condensed table_cont'>
	<thead>
        <tr>
        	<th>Concepto</th>
            <th>Saldo</th>
        </tr>
    </thead>

        <tbody>
            
	@foreach($vencidos as $pago)
	    <tr>
	    	{{--*/ $pago_date = explode("-", $pago->date);  /*--}}
	      	{{--*/ $total += $pago->amount; /*--}}
			<td><p>{!!$month[$pago_date[1]-1] . " " . $pago_date[0]!!}</p></td>
			<td>{{'$ '. number_format($pago->amount, 2) }}</td>
		</tr>
	@endforeach               
            
        </tbody>

        <tr>
        	<td>Total a pagar</td>
			<td>{{'$ '. number_format($total, 2) }}</td>
		</tr>
</table>


<br>
<p>Proceder a pagar:</p>
<div>
	<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	<input type="hidden" name="id_user" value="{{ Auth::user()->id }}" id="id_user">
	<a href="{{'pago/4'}}" class="btn-primary btn-block btn_paypal"></a>
</div>

<br><br>



<div id="cuenta_pago">
	
<br><br>
{{--*/ 

    $monto=0;

	if($total==0){ /*--}}

<h3>Ya puede realizar el siguiente pago. </h3>


<table class="table table-bordered">
	<tbody>
		<tr>
			<td class="text-center precio tipo_pago1">
				<div class="precio_box">
					<h1>Mensual</h1>
					<h3>{{'$ '. number_format($cuota, 2) }}</h3>
					<div class="precio_tx">
						<p>*Forma de pago por mes</p>
						<p>**Se acredita el ultimo mes con falta de pago</p>
					</div>
					<div>
						<button id='mensual' class='btn btn-primary btn-block btn_paypal' data-toggle="modal" data-target="#mensual"></button>
					</div>
				</div>
			</td>
			<td class="text-center precio tipo_pago2">
				<div class="precio_box">
					<h1>Semestral</h1>
					<h3>{{'$ '. number_format(($cuota*6), 2) }}</h3>
					<div class="precio_tx">
						<p>*Forma de pago para 6 meses</p>
						<p>**Se acredita desde el ultimo mes con falta de pago</p>	
					</div>
					<div>
						<button id='semestral' class='btn btn-primary btn-block btn_paypal' data-toggle="modal" data-target="#semestral"></button>
					</div>
				</div>
			</td>
			<td class="text-center precio tipo_pago3">
				<div class="precio_box">
					<h1>Anual</h1>
					<h3>{{'$ '. number_format(($cuota*11), 2) }}</h3>
					<div class="precio_tx">
						<p>*Forma de pago para 12 meses</p>
						<p>**Se acredita desde el ultimo mes con falta de pago</p>
						<p>***Un mes gratis con esta forma de pago</p>
					</div>
					<div>
						<button id='anual' class='btn btn-primary btn-block btn_paypal' data-toggle="modal" data-target="#anual"></button>
					</div>
				</div>
			</td>
		</tr>
	</tbody>
</table> 

	<div class="mid_cont">
		<img src="https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/TDC_btn_4.png" alt="undefined" />
		<img src="https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/TD_btn_1.png" alt="undefined" />
	</div>

{{--*/ } /*--}}

</div>

