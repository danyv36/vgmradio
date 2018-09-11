@extends('layouts.default')
@section('main_content')
<div class="container">
    <div class="form-signin">
    <h2 class="text-center">Log in</h2>

    {!! Form::open(['route' => 'sessions.store']) !!}

        <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email address" >
            {!! $errors->first('email', '<div class="alert alert-danger">:message</div>') !!}
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            {!! $errors->first('password', '<div class="alert alert-danger">:message</div>') !!}
        </div>

        <button type="submit" class="btn btn-primary btn-block create-playlist btn-lg">Log in</button>
    {!!Form::close()!!}
    
</div>

@include('footer')
@stop