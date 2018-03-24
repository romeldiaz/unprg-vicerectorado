@extends('layouts.perfil')

@section('content2')
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Edicion de Usuario</h3>
    </div>
    <div class="box-body">
      @include('partials.myAlertErrors')
      @if(Session::has('error_password'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Warning!</strong>
          <ul>
            <li>{{ Session::get('error_password') }}</li>
          </ul>
        </div>
      @endif

      <div class="form-horizontal">
        {{ Form::model($user, ['action'=>['PerfilController@update', $user->id], 'method'=>'PUT']) }}
        <div class="form-group">
          {{ Form::label('cuenta', 'Cuenta', ['class'=>'col-sm-3 control-label']) }}
          <div class="col-sm-9">
            {{ Form::text('cuenta', null, ['class'=>'form-control', 'placeholder'=>'Cuenta de usuario']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('nombres', 'Nombre(s)', ['class'=>'col-sm-3 control-label']) }}
          <div class="col-sm-9">
            {{ Form::text('nombres', null, ['class'=>'form-control', 'placeholder'=>'Nombre(s)']) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('paterno', 'A. Paterno', ['class'=>'col-sm-3 control-label']) }}
          <div class="col-sm-9">
            {{ Form::text('paterno', null, ['class'=>'form-control', 'placeholder'=>'Apellido paterno']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('materno', 'A. Materno', ['class'=>'col-sm-3 control-label']) }}
          <div class="col-sm-9">
            {{ Form::text('materno', null, ['class'=>'form-control', 'placeholder'=>'Apellido materno']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('password', 'Clave Actual', ['class'=>'col-sm-3 control-label']) }}
          <div class="col-sm-9">
            {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'Ingrese su clave actual']) }}
          </div>
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-sm btn-success">Guardar Cambios</button>
        </div>
        {{ Form::close() }}
      </div>

    </div>
    <!-- /.box-body -->
  </div>
@endsection

@section('script')

@endsection
