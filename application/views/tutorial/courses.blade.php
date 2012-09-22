<ul class="breadcrumb span6">
	<li>
		<a href="{{URL::home()}}">Home</a> <span class="divider">/</span>
	</li>
	<li class="active">Courses</li>
</ul>

@if(count($courses) == 0)
	<p>No Results.</p>

	{{Form::open()}}
		{{Form::label('course', 'Course: ')}}
		{{Form::text('course', Input::old('course'))}}

		{{Form::submit('Search')}}
	{{Form::close()}}
@else
	<table>
		<tr>
			<th>Course</th>
			<th>Tutorials</th>
		</tr>

		@foreach($courses as $course)
			<tr>
				<td><a href="{{URL::to('course/'.$course->id)}}">{{$course->name}}</a></td>
				<td>{{count($course->tutorials)}}</td>
			</tr>
		@endforeach
	</table>
@endif