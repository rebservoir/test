
		@if(empty($result))
			<table class="table table-striped">
				<thead id="thead_user">
					<tr>
						<th id="th1" class="th_op">Nombre
							<select id="nombre_select" name="nombre_select" class="select_user">
								<option value="null">--</option>
								<option value="name">A-Z</option>
								<option value="desc">Z-A</option>
							</select>
						</th>
						<th id="th2" class="th_op">Email
							<select id="status_select" name="status" class="select_user">
								<option value="null">--</option>
								<option value="email">A-Z</option>
								<option value="email_desc">Z-A</option>
							</select>
						</th>
						<th id="th3" class="th_op">Dirección</th>
						<th id="th4" class="th_op">Status<br>
							<select id="status_select" name="status" class="select_user">
								<option value="null">--</option>
								<option value="all">Todos</option>
								<option value="adeudo">Adeudo</option>
								<option value="corriente">Corriente</option>
								<option value="admin">Admin</option>
							</select></th>
						<th>Editar</th>
						<th>Pagos</th>
					</tr>
				</thead>

				<tbody>
					@foreach($users as $user)
						<tr>
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->address}}</td>
							<td>
								@if($user->role == 0)
									@if($user->status==1)
										<span class="label label-success">Ok</span>
									@elseif($user->status==0)
										<span class="label label-danger">Adeudo</span>
									@endif
								@elseif($user->role == 1)
									<span class="label label-info">Admin</span>
								@endif
							</td>
							<td><button value='{{$user->id}}' OnClick='Mostrar(this);' class='btn btn-primary' data-toggle="modal" data-target="#user_edit">Editar</button></td>
							
							@if($user->role==1)
								<td></td>
							@elseif($user->role==0)
								<td><button value='{{$user->id}}' OnClick='detalle_pagos(this)' class='btn btn-primary' data-toggle="modal" data-target="#detalle_pagos">Ver Detalle</button></td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif

			
<style>

	#thead_user th{
		cursor: pointer;
	}
	.th_op:hover{
		background-color: #C5DEF5;
	}
	.th_sel{
		background-color: #C5DEF5;
	}

div#paginate{
	float: right;
	margin-right: 50px;
}
tr{
	width: 100%;
	display: inline-table;  
    table-layout: fixed;
}
table{
    height: 650px;
}
tbody{
  	overflow-y: scroll;
    height: 600px;
  	position: absolute;
    border: 1px solid #e2e2e2;
    border-top: none;
}
thead th:nth-child(4){
	width: 120px;
	text-align: center;
}
tbody td:nth-child(4){
	width: 120px;
	text-align: center;
    padding-top: 18px !important;
}
thead th:nth-child(5){
	width: 80px;
	text-align: center;
}
tbody td:nth-child(5){
	width: 80px;
	text-align: center;
}
thead th:last-child{
    width: 120px;
    text-align: center;
}
tbody td:last-child{
    width: 120px;
    text-align: center;
}
tbody td:last-child .btn{
    background-color: #4CAF50;
	border-color: #459C48;

}
tbody td:last-child .btn:hover{
	background-color: #459C48;
	border-color: #459C48;

}

	
</style>

<script>
	/*+++++++++++++++++ usuario sort ++++++++++++++++++++*/

var current_sort = "#sort1";
var x;

function Toggle_sort(id_sel){
    $( current_sort ).addClass( "hidden" );
    x = document.getElementById(id_sel).value;
    current_sort= x;
    $( current_sort ).removeClass( "hidden" );
}


</script>