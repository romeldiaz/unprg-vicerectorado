@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-4">
    <div class="list-group">
      <a class="list-group-item ">USUARIOS</a>
      {{ link_to('oficinas', 'Oficinas', ['class'=>'list-group-item list-group-item-action']) }}
      {{ link_to('oficinas/create', 'Crear', ['class'=>'list-group-item list-group-item-action active']) }}
    </div>
  </div>

  <div class="col-8">
        {{ Form::open(['url'=>'oficinas'])}}
          <div class="form-group">
            {{ Form::hidden('id',null) }}
            {{ Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'Nombre de la oficina'])}}
          </div>
          <div class="form-group">
            {{ Form::submit('Aceptar', ['class'=>'btn btn-info'])}}
            {{ Link_to('oficinas', 'Cancelar', ['class'=>'btn btn-secondary'])}}
          </div>
        {{ Form::close()}}

  </div>
</div>

@stop

@section('scripts')

@stop
