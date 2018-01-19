<h1>Create New User</h1>

{{ Form::open(['route' => 'users.store']) }}

    <div>
        {{Form::label('username', 'Username: ')}}
        {{Form::input('text', 'username')}}
        {{ $errors->first('username') }}
    </div>
    <div>
        {{Form::label('password', 'Password: ')}}
        {{Form::password('password')}}
        {{ $errors->first('password') }}
    </div>

    <div>{{Form::submit('Register')}}</div>
{{Form::close()}}