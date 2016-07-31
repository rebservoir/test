<div id="msj-success" class="alert alert_top alert-success alert-dismissible hide" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div id="msj-fail" class="alert alert-danger alert-dismissible hide" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

		@if(count($errors) > 0)
			{{--*/ 
				$err = array("concept", "date", "amount", "Y-m-d");
				$ok = array("Concepto", "Fecha", "Cantidad", "año-mes-dia");
			/*--}}
			<br>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				@foreach($errors->all() as $error)
					<p>{!! str_replace($err, $ok, $error) !!}</p>
				@endforeach
			</div>
		@endif