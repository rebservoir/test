<div class="modal fade" id="semestral" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Pago Semestral</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_pass">
				<input type="hidden" id="">

			{{--*/ 
				$month = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");  
				$total = 0;
				$year_c = date('Y');
				$mes = date('n');
				$day = date('j');
				$j = $mes;
				$k = $year_c;
				$pago_hasta = ''; 
          		$pago_hasta_mes = '';
          		$monto = $cuota;
			/*--}}

@foreach($ultimo_p as $pa)
      {{--*/ 
        $pago_hasta = $pa->date; 
        $pago_hasta_mes = explode("-", $pago_hasta); 
        break;
      /*--}}
@endforeach

<input type="hidden" name="date" value="{{ $pago_hasta }}" id="begin_date">
<input type="hidden" name="user_name" value="{{ Auth::user()->name }}" id="user_name">
<input type="hidden" name="amount" value="{{ $monto }}" id="amount">

				<table class='table table-condensed table_cont'>
					<thead>
				        <tr>
				        	<th>Concepto</th>
				            <th>Monto</th>
				        </tr>
				    </thead>
				        <tbody>
				      		
							{{--*/

							if($pago_hasta_mes == ''){

							}else{
								$k = $pago_hasta_mes[0];
								$j = $pago_hasta_mes[1] + 1;

								if($j==13){
									$j=1;
									$k++;
								}
							}

							for($x=0;$x < 6; $x++){
								
								echo '<tr><td><p>' . $month[$j-1] . ' ' . $k . '</p></td>';
								echo '<td><p>$' . number_format($monto, 2) . '</p></td></tr>';
								$j++;
								$total += $monto;
								if($j==13){
									$j=1;
									$k++;
								}


							}

							/*--}}
       
				        </tbody>
				        <tr>
				        	<td>Total a pagar</td>
							<td>{{'$ '. number_format($total, 2) }}</td>
						</tr>
				</table>
				
			</div>
			
			<div class="modal-footer">
				{!!link_to('pago/2', $title='Proceder a Pagar', $attributes = ['class'=>'btn btn-primary'], $secure=null)!!}
			</div>
		</div>
	</div>
</div>
