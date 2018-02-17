
@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-4">
    <div class="list-group">
      <a class="list-group-item ">USUARIOS</a>
      {{ link_to('oficinas', 'Oficinas', ['class'=>'list-group-item list-group-item-action']) }}
      {{ link_to('oficinas/create', 'Crear', ['class'=>'list-group-item list-group-item-action']) }}
      {{ link_to_action('OficinaController@edit', 'Editar', $oficina->id, ['class'=>'list-group-item list-group-item-action active']) }}
    </div>
  </div>

  <div class="col-8">
    {{ Form::model($oficina, ['action'=>['OficinaController@update', $oficina->id], 'method'=>'PUT']) }}
      <div class="form-group">
        {{ Form::hidden('id',null) }}
        {{ Form::text('nombre', null, ['class'=>'form-control'])}}
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
