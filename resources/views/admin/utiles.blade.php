<div class="table-responsive">          
	<table class="table">
	    <thead><tr><th>Teléfonos de Emergencia</th></tr></thead>
	    <tbody>
			@foreach($utiles as $util)
				@if($util->category == 0)
					<tr>
					<td><p>{{$util->concept}}</p></td>
					<td><p>{{$util->address}}</p></td>
					<td><p>{{$util->phone_num}}</p></td>
					<td><p>{{$util->url}}</p></td>
					<td>{!!link_to_route('#', $title = 'Editar', $parameters = $util->id, $attributes = ['class'=>'btn btn-primary'])!!}</td>
					
					</tr>
				@endif
			@endforeach
	    </tbody>
  	</table>

  	<table class="table">
	    <thead><tr><th>Mi Sitio</th></tr></thead>
	    <tbody>
			@foreach($utiles as $util)
				@if($util->category == 1)
					<tr>
					<td><p>{{$util->concept}}</p></td>
					<td><p>{{$util->address}}</p></td>
					<td><p>{{$util->phone_num}}</p></td>
					<td><p>{{$util->url}}</p></td>
					</tr>
				@endif
			@endforeach
	    </tbody>
  	</table>

  	<table class="table">
	    <thead><tr><th>Tintorerias</th></tr></thead>
	    <tbody>
			@foreach($utiles as $util)
				@if($util->category == 2)
					<tr>
					<td><p>{{$util->concept}}</p></td>
					<td><p>{{$util->address}}</p></td>
					<td><p>{{$util->phone_num}}</p></td>
					<td><p>{{$util->url}}</p></td>
					</tr>
				@endif
			@endforeach
	    </tbody>
  	</table>

  	<table class="table">
	    <thead><tr><th>Taxi</th></tr></thead>
	    <tbody>
			@foreach($utiles as $util)
				@if($util->category == 3)
					<tr>
					<td><p>{{$util->concept}}</p></td>
					<td><p>{{$util->address}}</p></td>
					<td><p>{{$util->phone_num}}</p></td>
					<td><p>{{$util->url}}</p></td>
					</tr>
				@endif
			@endforeach
	    </tbody>
  	</table>

	<table class="table">
	    <thead><tr><th>Farmacias</th></tr></thead>
	    <tbody>
			@foreach($utiles as $util)
				@if($util->category == 4)
					<tr>
					<td><p>{{$util->concept}}</p></td>
					<td><p>{{$util->address}}</p></td>
					<td><p>{{$util->phone_num}}</p></td>
					<td><p>{{$util->url}}</p></td>
					</tr>
				@endif
			@endforeach
	    </tbody>
  	</table>

  	<table class="table">
	    <thead><tr><th>Gruas</th></tr></thead>
	    <tbody>
			@foreach($utiles as $util)
				@if($util->category == 5)
					<tr>
					<td><p>{{$util->concept}}</p></td>
					<td><p>{{$util->address}}</p></td>
					<td><p>{{$util->phone_num}}</p></td>
					<td><p>{{$util->url}}</p></td>
					</tr>
				@endif
			@endforeach
	    </tbody>
  	</table>

	<table class="table">
	    <thead><tr><th>Ferreterias</th></tr></thead>
	    <tbody>
			@foreach($utiles as $util)
				@if($util->category == 6)
					<tr>
					<td><p>{{$util->concept}}</p></td>
					<td><p>{{$util->address}}</p></td>
					<td><p>{{$util->phone_num}}</p></td>
					<td><p>{{$util->url}}</p></td>
					</tr>
				@endif
			@endforeach
	    </tbody>
  	</table>

	<table class="table">
	    <thead><tr><th>Otros</th></tr></thead>
	    <tbody>
			@foreach($utiles as $util)
				@if($util->category == 7)
					<tr>
					<td><p>{{$util->concept}}</p></td>
					<td><p>{{$util->address}}</p></td>
					<td><p>{{$util->phone_num}}</p></td>
					<td><p>{{$util->url}}</p></td>
					</tr>
				@endif
			@endforeach
	    </tbody>
  	</table>

 </div>



