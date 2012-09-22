<ul class="breadcrumb span6">
	<li>
		<a href="{{URL::home()}}">Home</a> <span class="divider">/</span>
	</li>
	<li>
		<a href="{{URL::to('tutorials')}}">Tutorials</a> <span class="divider">/</span>
	</li>	
	<li class="active">Tutorial</li>
</ul>

<div class="span16">
	<p><b>Tutor</b>: <a href="{{URL::to('user/'.$tutorial->tutor->id)}}">{{$tutorial->tutor->name}}</a></p>
	<p><b>Course</b>: {{$tutorial->course->name}}</p>
	<p><b>Likes:</b> {{$tutorial->likes}} </p>

	<p><b>Description:</b> {{$tutorial->description}}</p>

	@if( ! Auth::user()->in($tutorial->id))
		<p><a href="{{URL::to('tutorial/'.$tutorial->id.'/join')}}">Join</a> | 
	@endif

	<a href="{{URL::to('tutorial/1/like')}}">Like</a></p>
</div>