<div class="modal fade" id="pago_create" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Registro Manual de Pago</h4>
			</div>

			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

				<div id="the-basics" class="form-group" style="float:left;">
					{!!Form::label('*Usuario:')!!}
					{!!Form::text('id_user',null,['id'=>'search-input','class'=>'typeahead form-control','placeholder'=>'Ingresar nombre de usuario y seleccionar.'])!!}
				</div>
				
				<div id="showStatus">
					<p><b>Status:</b></p>
				</div>

				<div id="pagosContent" class="form-group">
					<p><b>Tabla de pagos:</b></p>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Sel.</th>
								<th>Concepto</th>
								<th>Status</th>
								<th>Cuota</th>
								<th>Retardo</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>

				</div>

				<div id="calculo" class="form-group">
					<div class="row">
						<div class="th l">
							<p><b>Adeudo:</b></p>
							<p><b>Recargos:</b></p>
							<p><b>Pendientes:</b></p>
							<p><b>Descuento:</b></p>
							<span></span>
							<p><b>Total:</b></p>
						</div>
						<div class="th r">
							<p>$0.00</p>
							<p>$0.00</p>
							<p>$0.00</p>
							<p>$0.00</p>
							<span></span>
							<p>$0.00</p>
						</div>
					</div>
				</div>

			</div>
				<div class="modal-footer">
					<div class="requeridos"><p>*Campos requeridos.</p></div>
					<div class="btn_go">
						{!!link_to('#', $title='Registrar pago', $attributes = ['id'=>'registrar_pago', 'class'=>'btn btn-primary'], $secure=null)!!}
					</div>
					<div class="procesando hide">
						<p>Procesando...</p>
					</div>
				</div>
		</div>
	</div>
</div>


<style type="text/css">
.label{
    font-size: 12px !important;
}
#showStatus{
	width: 100%;
	display: inline-block;
	margin-bottom: 20px;
}
#showStatus p{
	display: inline;
}
#pagosContent{
	width: 100%;
	display: inline-block;
}
#calculo{
	display: inline-block;
	width: 100%;
	padding-left: 15px;
	padding-right: 15px;
}
#calculo span{
	display: inline-block;
    width: 100%;
    border-top: 1px solid;
    padding-bottom: 10px;
}
.l{
	float: left;
}
.r{
	float: right;
}
.th{
	display: inline-block;
	width: 50%;
}

</style>
					
					