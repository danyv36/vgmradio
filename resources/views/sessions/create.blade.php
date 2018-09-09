<!doctype html>

<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    {{ Form::open(['route' => 'sessions.store']) }}
    <div>
        {{Form::label('email', 'Email: ')}}
        {{Form::input('text', 'email')}}
    </div>
    <div>
        {{Form::label('password', 'Password: ')}}
        {{Form::password('password')}}
    </div>

    <div>{{Form::submit('Login')}}</div>
    {{ Form::close() }}
</body>
</html>