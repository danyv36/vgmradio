@extends('layouts.default')
@section('main_content')
<div class="container">
    <h2>Create New User</h2>

    {!! Form::open(['route' => 'users.store']) !!}

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" >
            {!! $errors->first('email') !!}
        </div>
        <div class="form-group">
            <label for="confirm-email">Confirm e-mail</label>
            <input type="email" class="form-control" id="confirm-email" name="confirm-email">
            {!! $errors->first('confirm-email') !!}
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            {!! $errors->first('password') !!}
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm password</label>
            <input type="password" class="form-control" id="confirm-password" name="confirm-password">
            {!! $errors->first('confirm-password', '<span class=error>:message</span>') !!}
        </div>

        <button type="submit" class="btn btn-info create-playlist">Register</button>
    {!!Form::close()!!}
</div>

@include('footer')
@stop