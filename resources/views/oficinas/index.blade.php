@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item ">USUARIOS</a>
      {{ link_to('oficinas', 'Oficinas', ['class'=>'list-group-item list-group-item-action active']) }}
      {{ link_to('oficinas/create', 'Crear', ['class'=>'list-group-item list-group-item-action']) }}
    </div>
  </div>

  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-lista" role="tabpanel" aria-labelledby="list-lista-list">
        <table class="table table-hover table-sm">
          <thead>
            <tr>
              <th>N°</th>
              <th>Nombre</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $num=0; ?>
            @foreach($oficinas as $key => $oficina)
            <?php $num++; ?>
            <tr>
              <td>{{$num}}</td>
              <td>{{$oficina->nombre}}</td>
              <td>
                <div class="form-inline">

                  {{ Form::open(['action'=>['OficinaController@destroy', $oficina->id], 'method'=>'DELETE']) }}
                    {{ Form::submit('Borrar', ['class'=>'btn btn-sm btn-info mr-1']) }}
                  {{ Form::close()}}

                  {{ link_to_action('OficinaController@edit', 'Editar', $oficina->id, ['class'=>'btn btn-sm btn-secondary']) }}
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


@stop
