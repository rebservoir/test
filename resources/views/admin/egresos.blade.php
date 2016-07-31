<h3>Egresos</h3>

<!-- Egresos ALERTS -->
<div id="msj-success-egreso" class="alert alert-success alert-dismissible hide" role="alert">
</div>
<div id="msj-fail-egreso" class="alert alert-danger alert-dismissible hide" role="alert">
</div>


<!-- Egresos ALERTS END -->

<button class='btn btn-primary' onclick="close_modals();"  data-toggle="modal" data-target="#egresos_create">Registrar Egresos</button>
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
          echo "<li class='active'><a href='#e" . $j  . "'>" . $j . "</a></li>";
        else
          echo "<li><a href='#e" . $j  . "'>" . $j . "</a></li>";
        }
    /*--}}   
  </ul>

	<br><br>

<div class="tab-content">

  {{--*/ 
    for ($j = 2015; $j < 2018; $j++) {
      if($j==$year_c)
        echo "<div id='e" . $j . "' class='tab-pane fade in active'>";
      else
        echo "<div id='e" . $j . "' class='tab-pane fade'>"; 
  /*--}} 

  <ul class="nav nav-tabs">
    {{--*/ 
      for ($k = 0; $k < 12; $k++) {
        if(($k+1)==$mes)
          echo "<li class='active'><a href='#e" .$month[$k] . $j . "'>".$month[$k]."</a></li>";
        else
          echo "<li><a href='#e" .$month[$k] . $j ."'>".$month[$k]."</a></li>";         
        }
    /*--}}
  </ul>

  {{--*/ 
    for ($q = 0; $q < 12; $q++) {
      if(($q+1)==$mes)
        echo "<div id='e" . $month[$q] . $j . "' class='tab-pane fade in active'>";
      else
        echo "<div id='e" . $month[$q] . $j . "' class='tab-pane fade'>"; 
  /*--}} 

    <br><br>

<div id="tablaEgresos">
	<table class="table table-striped">
		<thead>
					<th>Fecha</th>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>Archivo</th>
					<th>Editar</th>
				</thead>

				<tbody>
					@foreach($egresos as $egreso)
						{{--*/ $date = explode("-", $egreso->date) /*--}}
						@if(($date[1] == ($q+1)) && ($date[0] == $j))
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
								<td><button value='{{$egreso->id}}' OnClick='Mostrar_egresos(this)' class='btn btn-primary' data-toggle="modal" data-target="#egresos_edit">Editar</button></td>
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




<style>
.fade {
    display: none !important;
}
.fade.in {
    display: block !important;
}
</style>