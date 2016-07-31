

<div class="table-responsive">          
	<table class="table">
	    <thead>
	      <tr>
	        <th>Politicas Internas</th>
	      </tr>
	    </thead>

	    <tbody>
			@foreach($documentos as $doc)
				<tr>      	
					<td><p><a href="/file/{{$doc->path}}" target="_blank">{{$doc->titulo}}</a></p></td>
				</tr>
			@endforeach
	    </tbody>
  	</table>
 </div>



