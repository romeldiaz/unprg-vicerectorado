@extends('layouts.dashPanel')

@section('title', 'Login')

@section('content')


<div class="row justify-content-center">
  <div class="col col-sm-12 col-md-6 col-lg-4">
    <div class="align-self-center ">
      
      @if(Session::has('logout_msn'))
        <div class="alert alert-warning" role="alert">
          {{ Session::get('logout_msn') }}
        </div>
      @elseif(Session::has('login_error'))
        <div class="alert alert-danger" role="alert">
          {{ Session::get('login_error') }}
        </div>
      @endif

      @include('partials.myMessage')
      {{ Form::open(['action'=>'AuthController@login']) }}
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text icon-user"></span>
            </div>
            {{ Form::text('cuenta', null, ['class'=>'form-control', 'placeholder'=>'usuario']) }}
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text icon-lock"></span>
            </div>
            {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'********']) }}
          </div>
        </div>

        <label>
          {{ Form::checkbox('remember', true) }} Remember me
        </label>
        {{  form::submit('Entrar', ['class'=>'btn btn-info btn-block']) }}
      {{ Form::close() }}

    </div>
  </div>

</div>


@stop

@section('scripts')

@stop
