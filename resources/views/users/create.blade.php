@extends('layouts.default')
@section('main_content')
<div class="container">
    <div class="form-signin">
    <h2 class="text-center">Sign up</h2>

    {!! Form::open(['route' => 'users.store', 'class' => 'form-horizontal']) !!}

        <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email" >
            {!! $errors->first('email', '<div class="alert alert-danger">:message</div>') !!}
        </div>
        <div class="form-group">
            <input type="email" class="form-control" id="confirm-email" name="confirm-email" value="{{ old('confirm-email') }}" placeholder="Confirm email">
            {!! $errors->first('confirm-email', '<div class="alert alert-danger">:message</div>') !!}
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            {!! $errors->first('password', '<div class="alert alert-danger">:message</div>') !!}
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm password">
            {!! $errors->first('confirm-password', '<div class="alert alert-danger">:message</div>') !!}
        </div>

        <button type="submit" class="btn btn-primary btn-block create-playlist btn-lg">Register</button>
    {!!Form::close()!!}
    
</div>

@include('footer')
@stop