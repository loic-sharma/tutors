{{Form::open()}}
	<table>
		<tr>
			<td>{{Form::label('email', 'Email: ')}}</td>
			<td>{{Form::text('email', Input::old('email'))}}</td>
		</tr>

		<tr>
			<td>{{Form::label('password', 'Password: ')}}</td>
			<td>{{Form::password('password')}}</td>
		</tr>
	</table>

	{{Form::submit('Login')}}
{{Form::close()}}


<p>Don't have an account? <a href="{{URL::to('register')}}">Register</a>.</p>