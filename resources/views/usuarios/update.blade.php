



@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col col-sm-12">
    <div class="msn">
      @if(count($errors)>0)
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Mensaje!</strong>
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    </div>

    {{ Form::model($usuario, ['action'=>['UsuarioController@update', $usuario->id], 'method'=>'PUT']) }}
      {!! Form::hidden('page','update') !!} <!--Para controlar el script usuario js-->
      {!!Form::hidden('id', null)!!}
      <div class="form-group">
        {!!Form::text('nombre', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Nombre'])!!}
      </div>
      <div class="form-group">
        {!!Form::text('paterno', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Apellido paterno'])!!}
      </div>
      <div class="form-group">
        {!!Form::text('materno', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Apellido materno'])!!}
      </div>
      <div class="form-group">
        {!!Form::text('cuenta', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Cuenta'])!!}
      </div>
      <div class="form-group">
        {!!Form::password('clave', ['class'=>'form-control form-control-sm', 'placeholder'=>'*******'])!!}
      </div>

      <div class="form-group">
        <?php

          $opciones = array();
          foreach($oficinas as $oficina){
            $opciones[$oficina['id']] = $oficina['nombre'];
          }
         ?>
        {!! Form::select('oficina_id',$opciones,null,['class'=>'form-control form-control-sm', 'placeholder'=>'Seleccione una oficina']) !!}
      </div>

      <div class="form-check">
        <?php
        $cbxState;
        if($usuario->jefe){
          $cbxState = 'enabled';
        }else{
          //verficar si la oficina ya tiene jefe
          if(count($checkOficina)==0){//oficina aun no tiene jefe
            $cbxState = 'enable';
          }else{
            $cbxState = 'disabled';
          }
        }
         ?>

        {!!Form::checkbox('jefe', null ,null, ['class'=>'form-check-input form-check-input-sm', 'id'=>'jefe', $cbxState  ])!!}
        <label for="jefe" class="form-check-label">Establecer usuario como jefe de esta oficina</label>
      </div>

      {{ link_to_action('UsuarioController@index', 'Cancelar', [], ['class'=>'btn btn-sm btn-secondary']) }}
      {{ Form::submit('Editar', ['class'=>'btn btn-sm btn-info']) }}
    {!! Form::close() !!}

  </div>
</div>

@stop

@section('scripts')
<script type="text/javascript" src="{{url('js/usuario.js')}}"></script>
@stop
