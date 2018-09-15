@extends('layouts.default')
@section('main_content')
<div class="container">
    <div class="form-signin">
    <h3 class="text-center">Enter your activation code</h3>

    {!! Form::open(['route' => 'activateAccount', 'class' => 'form-horizontal']) !!}

        <div class="form-group">
            <input type="confirm" class="form-control" id="confirm" name="confirm" value="{{ old('confirm') }}" placeholder="Activation code" >
            {!! $errors->first('confirm', '<div class="alert alert-danger">:message</div>') !!}
        </div>

        <button type="submit" class="btn btn-primary btn-block create-playlist btn-lg">Activate account</button>
    {!!Form::close()!!}
    
</div>

@include('footer')
@stop