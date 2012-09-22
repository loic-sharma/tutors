{{Form::open()}}
	<table>
		<tr>
			<td>{{Form::label('name', 'Name: ')}}</td>
			<td>{{Form::text('name', Input::old('name'))}}</td>
		</tr>

		<tr>
			<td>{{Form::label('email', 'Email: ')}}</td>
			<td>{{Form::text('email', Input::old('email'))}}</td>
		</tr>

		<tr>
			<td>{{Form::label('password', 'Password: ')}}</td>
			<td>{{Form::password('password')}}</td>
		</tr>

		<tr>
			<td>{{Form::label('password_confirmation', 'Confirm Password: ')}}</td>
			<td>{{Form::password('password_confirmation')}}</td>
		</tr>
	</table>

	{{Form::submit('Register')}}
{{Form::close()}}


<p>Have an account? <a href="{{URL::to('login')}}">Login</a>.</p>