<ul class="breadcrumb span6">
	<li>
		<a href="{{URL::home()}}">Home</a> <span class="divider">/</span>
	</li>

	<li class="active">Tutorials</li>
</ul>


<table>
	<tr>
		<th>Tutorial Name</th>
		<th>Tutor</th>
		<th>Likes</th>
	</tr>

	@foreach($tutorials as $tutorial)
		<tr>
			<td><a href="{{URL::to('tutorial/'.$tutorial->id)}}">{{$tutorial->name}}</a></td>
			<td>{{$tutorial->tutor->name}}</td>
			<td>{{$tutorial->likes}}</td>
		</tr>
	@endforeach
</table>