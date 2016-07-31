@if(Session::has('update'))
	<br>
	<div id="alert-success" class="alert alert_top alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  {{Session::get('update')}}
	</div>
@endif