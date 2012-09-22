<div class="span16">
	<ul class="breadcrumb span6">
	<li>
		<a href="{{URL::home()}}">Home</a> <span class="divider">/</span>
	</li>
	<li class="active">Search</li>
</ul>
</div>

{{Form::open()}}
	{{Form::label('course', 'Course: ')}}
	{{Form::text('course', Input::old('course'))}}

	{{Form::submit('Search')}}
{{Form::close()}}
