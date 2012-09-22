<ul class="breadcrumb span6">
	<li>
		<a href="{{URL::home()}}">Home</a> <span class="divider">/</span>
	</li>
	<li>
		<a href="{{URL::to('tutorials')}}">Tutorials</a> <span class="divider">/</span>
	</li>	
	<li class="active">Create</li>
</ul>

{{Form::open()}}
	<table>
		<tr>
			<td>Name:</td>
			<td>{{Form::text('name', Input::old('name'))}}</td>
		</tr>

		<tr>
			<td>Description:</td>
			<td>{{Form::textarea('description', Input::old('description'))}}</td>
		</tr>
		<tr>
			<td>Course</td>
			<td>{{Form::select('course', $courses)}}</td>
		</tr>
	</table>

	{{Form::submit('Create')}}
{{Form::close()}}