<h3>Envió de Correos</h3>

<div id="msj-success-email" class="alert alert-success alert-dismissible hide" role="alert">
  <p>Correo enviado exitosamente.</p>
</div>
<div id="msj-fail-email" class="alert alert-danger alert-dismissible hide" role="alert">
  <div class="msj"></div>
</div>

	<div class="row">
	  	<div class="col-xs-6">
			<h4>Tipo de Correo:</h4>
				<select id='tipo_select' name='tipo_select' class='select_correo'>
					<option value='1' selected='selected'>Mensaje</option>
					<option value='2'>Corte</option>
					<option value='3'>Adeudo</option>
				</select>
	  	</div>
	  	<div class="col-xs-6">
			<h4>Para:</h4>
				<select id='to_select' name='to_select' class='select_correo'>
					<option value='1' selected='selected'>Todos</option>
					<option value='2'>Adeudo</option>
					<option value='3'>Corriente</option>
					<option value='4'>Seleccionar</option>
				</select>
	  	</div>
	</div>

		<br>

	<div id="add_user" class="hidden">
		<p>Buscar por nombre, seleccionar y presionar el botón para añadir destinatario.</p>
		<div id="the-basics" class="form-group">
			<input type="text" id="search-input" class="typeahead form-control" placeholder="Buscar..." >
			<button value='' OnClick='add();' class='btn btn-primary'>Añadir</button>		
		</div>
	</div>

	<h4>Destinatarios:</h4>

		<div id="user_table">
			<table class="table table-striped">
				<thead>
					<th>Marcar</th>
					<th>Nombre</th>
					<th>Email</th>
					<th>Status</th>
				</thead>
			</table>	
		</div>

	<div id="tipos">
		<div>
			<h4>Asunto:</h4>
			<input type="text" id="txt_subj" style="width: 300px;">
		</div>
		<div>
			<h4>Redactar mensaje:</h4>
			<textarea id="txt_msg" rows='5' cols='50'>
			</textarea>
		</div>
	</div>

	<br>
<input type="hidden" name="token_send" value="{{ csrf_token() }}" id="token_send">
<button id="btn_send" class='btn btn-primary'>Enviar Correo</button>


<style type="text/css">

#user_table{
}

tr {
	width: 100%;
	display: inline-table;  
    table-layout: fixed;
}

table{
 	height:300px; 
}
tbody{
  	overflow-y: scroll;
  	height: 260px;
  	position: absolute;
    border: 1px solid #e2e2e2;
    border-top: none;
}
thead th:last-child {
    text-align: center;
}
tbody td:last-child {
    text-align: center;
}

#user_table thead th:first-child{
    width: 80px;
	text-align: center;
}
#user_table tbody td:first-child{
    width: 80px;
	text-align: center;
}

</style>



