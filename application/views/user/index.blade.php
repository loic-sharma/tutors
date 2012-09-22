<p>Your email address is: {{Auth::user()->email}}. </p>

<p><a href="{{URL::to('logout')}}">Logout</a></p>

<h1>Tutoring Sessions</h1>


@if(count(Auth::user()->sessions) == 0)
	<p>You have not signed up to any Tutoring Sessions.</p>
@else
	<table>
		<tr>
			<th>Course Name</th>
			<th>Tutor</th>
		</tr>

		@foreach(Auth::user()->sessions as $session)
			<tr>
				<td><a href="{{URL::to('tutorial/1')}}">{{$session->name}}</a></td>
				<td>{{$session->tutor->name}}</td>
			</tr>
		@endforeach
	</table>
@endif

<a href="{{URL::to('find')}}">[+] Find a tutor.</a>

<h1>Your Tutoring</h1>

@if(count(Auth::user()->tutorials) == 0)
	<p>You do not teach any tutoring sessions.</p>
@else
	<table>
		<tr>
			<th>Name</th>
			<th>Course</th>
			<th>Pupils</th>
		</tr>
		@foreach(Auth::user()->tutorials as $tutorial)
			<tr>
				<td><a href="{{URL::to('tutorial/'.$tutorial->id)}}">{{$tutorial->name}}</a></td>
				<td>{{$tutorial->course->name}}</td>
				<td>{{count($tutorial->pupils)}}</td>
			</tr>
		@endforeach
	</table>
@endif

<a href="{{URL::to('create')}}">[+] Teach a Tutoring Sessions</a>