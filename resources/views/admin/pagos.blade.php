<!-- ALERTAS PAGOS -->

<div id="msj-success-pago" class="alert alert-success alert-dismissible hide" role="alert">
</div>
<div id="msj-fail-pago" class="alert alert-danger alert-dismissible hide" role="alert">
</div>

<!-- ALERTAS PAGOS END -->

<h3>Pagos</h3>
<button class='btn btn-primary' data-toggle="modal" data-target="#pago_create">Registrar Pago Manual</button>

<br><br>

{{--*/ 
$month = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$year_c = date('Y');
$mes = date('n');
$day = date('j');

/*--}}

  <ul class="nav nav-tabs">
    {{--*/ 
      for ($j = 2015; $j < 2018; $j++) {
        if( $j == $year_c)
          echo "<li class='active'><a href='#" . $j  . "'>" . $j . "</a></li>";
        else
          echo "<li><a href='#" . $j  . "'>" . $j . "</a></li>";
        }
    /*--}}   
  </ul>

	<br><br>

<div class="tab-content">

  {{--*/ 
    for ($j = 2015; $j < 2018; $j++) {
      if($j==$year_c)
        echo "<div id='" . $j . "' class='tab-pane fade in active'>";
      else
        echo "<div id='" . $j . "' class='tab-pane fade'>"; 
  /*--}} 

  <ul class="nav nav-tabs">
    {{--*/ 
      for ($k = 0; $k < 12; $k++) {
        if(($k+1)==$mes)
          echo "<li class='active'><a href='#" .$month[$k] . $j . "'>".$month[$k]."</a></li>";
        else
          echo "<li><a href='#" .$month[$k] . $j ."'>".$month[$k]."</a></li>";         
        }
    /*--}}
  </ul>

  {{--*/ 
    for ($q = 0; $q < 12; $q++) {
      if(($q+1)==$mes)
        echo "<div id='" . $month[$q] . $j . "' class='tab-pane fade in active'>";
      else
        echo "<div id='" . $month[$q] . $j . "' class='tab-pane fade'>"; 
  /*--}} 

    <br><br>

<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_correo">

<div id="tablaPagos">
	<table class="table table-striped">
		<thead>
			<th>Usuario</th>
			<th>Monto</th>
      <th>Retardo</th>
			<th>Fecha</th>
			<th>Editar</th>
      <th>Enviar</th>
		</thead>
		<tbody id="datos">
			@foreach($pagos as $pago)
			    {{--*/ $date = explode("-", $pago->date) /*--}}
			    @if(($date[1] == ($q+1)) && ($date[0] == $j))
					<tr>
						<td><p>{{$pago->user_name}}</p></td>
						{{--*/ $money = number_format($pago->amount, 2, '.', '') /*--}}
            {{--*/ $retardo = number_format($pago->retardo, 2, '.', '') /*--}}
						<td><p>{{'$ '.$money}}</p></td>
            <td><p>{{'$ '.$retardo}}</p></td>
						<td><p>{{$pago->date}}</p></td>
						<td><button value='{{$pago->id}}' OnClick='Mostrar_pago(this)' class='btn btn-primary' data-toggle="modal" data-target="#pago_edit">Editar</button></td>
					  <td><button value='{{$pago->id}}' class='btn btn_g'>Enviar</button></td>
          </tr>
			    @endif
			@endforeach 
		</tbody>
	</table>
</div>
  
    </div> 

  {{--*/ 
    }
  /*--}}

  {{--*/ 
        echo "</div>"; 
    }
  /*--}}   

</div> <!-- END tab-content -->