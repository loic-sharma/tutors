<ul class="breadcrumb span6">
	<li>
		<a href="{{URL::home()}}">Home</a> <span class="divider">/</span>
	</li>
	<li>
		<a href="{{URL::to('tutorials')}}">Users</a> <span class="divider">/</span>
	</li>	
	<li class="active">User</li>
</ul>

<div class="span16">
	<p><b>Email:</b> <a href="mailto:{{$user->email}}">{{$user->email}}</a>
	<p><b>Likes:</b> {{$user->likes}} </p>

	<p><a href="{{URL::to('user/'.$user->id.'/like')}}">Like</a></p>
</div>

<div class="span16">
	<h1>Teaches</h1>
	<hr>

	<table>
		<tr>
			<th>Tutoring Session</th>
			<th>Course</th>
			<th>Like</th>
		</tr>

		@foreach($user->tutorials as $tutorial)
			<tr>
				<td><a href="{{URL::to('tutorial/'.$tutorial->id)}}">{{$tutorial->name}}</a></td>
				<td>{{$tutorial->course->name}}</td>
				<td>{{$tutorial->likes}}</td>
			</tr
		@endforeach
	</table>
</div>
