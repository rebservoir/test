{{--*/ 
$year = array(2013,2014,2015,2016);
$month = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$year_c = date('Y');
$mes = date('n');
$day = date('j');

$d_corte = 15;
$m_corte = 0;
$y_corte = 0;
$d_vence = 21;
$status = 1;

  if($day>15){
    if($mes == 12){
      $m_corte=0;
      $y_corte = $year_c+1;
    }else{
      $m_corte=$mes;
      $y_corte = $year_c;
    }
  }else{
      $m_corte=$mes-1;
      $y_corte = $year_c;
  }

  $saldo=0;
  $pago_hasta_mes = '';
  $pago_hasta = '';
  $pago_monto = 0;

/*--}}


@foreach($pagos as $pago)
  @if($pago->id_user == Auth::user()->id)
    @if($pago->status == 0)
      {{--*/ 
          $saldo += $pago->amount;
      /*--}}
    @endif
  @endif
@endforeach

@foreach($ultimo_p as $pa)
      {{--*/ 
        $pago_hasta = $pa->date; 
        $pago_monto = $pa->amount; 
        $pago_hasta_mes = explode("-", $pago_hasta); 
        break;
      /*--}}
@endforeach

@if(!empty($vencidos))
  {{--*/ $status = 0 /*--}}
@endif


<h3>Factura al Corte</h3>

<table class="table table-bordered table-striped table-condensed ">
  <tbody>
    <tr>
      <td><p>Cliente: </p></td>
      <td><p>{!!Auth::user()->name!!}</p></td>
    </tr>
    <tr>
      <td><p>Status de Pago:</p></td>
        <td><h3 style="margin-top: 10px">
          @if($status == 0)
            <span class="label label-danger">Adeudo</span>
          @else
            <span class="label label-success">Al corriente</span>
          @endif
          </h3>
      </td>
    </tr>
    <tr>
      <td><p>Pagado hasta</p></td>
      {{--*/ 
        if($pago_hasta_mes == ''){
      /*--}}
      <td><p>No disponible</p></td>
      {{--*/ }else{ /*--}}
      <td><p>{!!$month[$pago_hasta_mes[1]-1]!!} {!!$pago_hasta_mes[0]!!}</p></td>
      {{--*/ } /*--}}
    </tr>
    <tr>
      {{--*/ 
        if($pago_hasta_mes == ''){
      /*--}}
      <td><p>Ultimo pago</p></td>
      <td><p>No disponible</p></td>
      {{--*/ }else{ /*--}}
      <td><p>Ultimo pago - {{ $pago_hasta_mes[2] . "-" . $month[$pago_hasta_mes[1]-1] . "-" . $pago_hasta_mes[0]  }}</p></td>
      <td><p>{{'$ '. number_format($pago_monto, 2) }}</p></td>
      {{--*/ } /*--}}
    </tr>
    <tr>
      <td><p>Fecha de corte</p></td>

      <td><p>{{ $d_corte."-".$month[$m_corte]."-".$y_corte }}</p></td>
    </tr>
    <tr>
      <td><p>Fecha Limite de Pago</p></td>
      <td><p>{{ $d_vence."-".$month[$m_corte]."-".$y_corte }}</p></td>
    </tr>
    <tr>
      <td><p>Saldo Vencido</p></td>
      <td><p>{{'$ '. number_format($saldo, 2) }}</p></td>
    </tr>
  </tbody>
</table>

  <br>
    <h3>Tabla de pagos</h3>
  <br>

  <ul class="nav nav-tabs">
    {{--*/ 
      for ($j = $year_c-2; $j < $year_c+2; $j++) {
        if( $j == $year_c)
          echo "<li class='active'><a href='#" . $j  . "'>" . $j . "</a></li>";
        else
          echo "<li><a href='#" . $j  . "'>" . $j . "</a></li>";
        }
    /*--}}   
  </ul>
  
  <br>

<div class="tab-content">

  {{--*/ 
    for ($j = $year_c-2; $j < $year_c+2; $j++) {
      if($j==$year_c)
        echo "<div id='" . $j . "' class='tab-pane fade in active'>";
      else
        echo "<div id='" . $j . "' class='tab-pane fade'>"; 
  /*--}} 

  <ul class="nav nav-tabs">
    {{--*/ 
      for ($k = 0; $k < 12; $k++) {
    /*--}}

      @foreach($pagos as $pago)
        {{--*/ $date = explode("-", $pago->date) /*--}}
          @if(($date[1] == ($k+1)) && ($date[0] == $j))
            @if($pago->status == 0)
                {{--*/ 
                    if(($k+1)==$mes)
                      echo "<li class='active'><a class='adeudo' href='#" .$month[$k] . $j . "'>".$month[$k]."</a></li>";
                    else
                      echo "<li><a class='adeudo' href='#" .$month[$k] . $j ."'>".$month[$k]."</a></li>";         
                /*--}}
            @elseif($pago->status == 1)
                {{--*/ 
                    if(($k+1)==$mes)
                      echo "<li class='active'><a class='saldado' href='#" .$month[$k] . $j . "'>".$month[$k]."</a></li>";
                    else
                      echo "<li><a class='saldado' href='#" .$month[$k] . $j ."'>".$month[$k]."</a></li>";         
                /*--}}
            @endif
          @endif
      @endforeach
  {{--*/ 
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

@foreach($pagos as $pago)
    {{--*/ $date = explode("-", $pago->date) /*--}}
    @if(($date[1] == ($q+1)) && ($date[0] == $j))
        <table class='table table-condensed'>
          <tbody>
            <tr>
              <td><strong>Status:</strong></td>
                <td><h3 style="margin-top:10px;">
                  @if($pago->status == 1)
                    <span class="label label-success">Saldado</span>
                  @else
                    <span class="label label-danger">Adeudo</span>
                  @endif
                </h3></td>
            </tr>
            <tr>
              <td><strong>Fecha:</strong></td>
              {{--*/ $cxd = $date[1] /*--}}
              <td>{{ $date[2] . "-" . $month[$cxd-1] . "-" . $date[0]}}</td>
            </tr>
            <tr>
              <td><strong>Cliente:</strong></td>
              <td>{{Auth::user()->name}}</td>
            </tr>
            <tr>
              <td><strong>Dirección:</strong></td>
              <td>{{Auth::user()->address}}</td>
            </tr>
          </tbody>
        </table>

        <table class='table table-condensed'>
          <thead>
            <tr>
              <th>Concepto</th>
              <th>Precio Unitario</th>
              <th>Descuento</th>
              <th>Importe</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><p>Aportación</p></td>
              <td>{{'$ '. number_format($cuota, 2) }}</td>
              <td>0%</td>
              <td>{{'$ '. number_format($pago->amount, 2) }}</td>
            </tr>
          </tbody>
        </table>            
    @endif
@endforeach 

  
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

.saldado{
  background-color: #5cb85c;
  color: #fff; 
}
.adeudo{
  background-color: #d9534f;
  color: #fff; 
}
</style>





