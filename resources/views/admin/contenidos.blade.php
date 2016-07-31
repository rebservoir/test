@extends('admin.admin')

	@include('admin.modal.util_edit')
	@include('admin.modal.util_create')
	@include('admin.modal.noticia_create')
	@include('admin.modal.noticia_edit')
	@include('admin.modal.documento_create')
	@include('admin.modal.documento_edit')

	@include('admin.nav')

	@section('content')

		@include('alerts.update')
		@include('alerts.msg')

		<div id="main_cont">
			<div class="cont_left cont_600 col-lg-4">
				<div class="box_header">
					<div class="bx_title bx_80">
						{!!Html::image('img/n_8.png')!!}
						<h1>Contenidos</h1>
					</div>

					<div class="bx_20">
						<button class="burger">
							<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
		       			</button>
					</div>
				</div>
						
				<ul id="ul_interna" class="nav_menu">
					<li id="int_l1" class="left_sel">	<p>Edición de Noticias</p></li>
					<li id="int_l2">					<p>Ventana Morosos</p></li>
					<li id="int_l3">					<p>Pestaña Finanzas</p></li>
					<li id="int_l4">					<p>Teléfonos y Lugares Útiles</p></li>
					<li id="int_l5">					<p>Documentos</p></li>
				</ul>
						
			</div>

			<div class="cont_right col-lg-8">

				<div id="int_div1" class="int_div_sel">
					<div class="box_header">
						<p>Contenidos > Edición de Noticias</p>
					</div>
						
					<div class="cont_in_r">
						@include('admin/noticia_create')
					</div>
				</div>

				<div id="int_div2" class="int_div">
					<div class="box_header">
						<p>Contenidos > Ventana Morosos</p>
					</div>
						
					<div class="cont_in_r">
						@include('admin/morosos')
					</div>
				</div>

				<div id="int_div3" class="int_div">
					<div class="box_header">
						<p>Contenidos > Pestaña Finanzas</p>
					</div>
						
					<div class="cont_in_r">
						@include('admin/trans')
					</div>
				</div>

				<div id="int_div4" class="int_div">
					<div class="box_header">
						<p>Contenidos > Teléfonos y Lugares Útiles</p>
					</div>
						
					<div class="cont_in_r">
						@include('admin/utiles_create')
					</div>
				</div>

				<div id="int_div5" class="int_div">
					<div class="box_header">
						<p>Contenidos > Documentos</p>
					</div>
						
					<div class="cont_in_r">
						@include('admin/documentos')
					</div>
				</div>

			</div> <!-- END cont_right -->

		</div> <!-- END main_cont -->

	@stop

	@section('script')
		{!!Html::script('js/contenidos.js')!!}
	@stop


<style type="text/css">

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
thead th:last-child{
    width: 100px;
}
tbody td:last-child{
    width: 100px;
}

</style>