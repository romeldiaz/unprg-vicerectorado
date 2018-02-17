@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col col-sm-12">

    <a href="javascript: consultarController()">Consultar Controller</a>


    <table class="table table-hover table-sm">
      <thead>
        <tr>
          <th>N°</th>
          <th>Nombres</th>
          <th>Paterno</th>
          <th>Materno</th>
          <th>Cuenta</th>
          <th>Clave</th>
          <th>Jefe</th>
          <th>Oficina ID</th>
          <th>{{ link_to_action('UsuarioController@create', 'Crear', [], ['class'=>'btn btn-sm btn-danger']) }}</th>
        </tr>
      </thead>
      <tbody>
        <?php $num=0; ?>
        @foreach($usuarios as $key => $usuario)
        <?php $num++; ?>
        <tr>
          <td>{{$num}}</td>
          <td>{{$usuario->nombre}}</td>
          <td>{{$usuario->paterno}}</td>
          <td>{{$usuario->materno}}</td>
          <td>{{$usuario->cuenta}}</td>
          <td>{{$usuario->clave}}</td>
          <td>{{$usuario->jefe}}</td>
          <td>{{$usuario->oficina_id}}</td>
          <td>
            <div class="form-inline">
              {{ Form::open(['action'=>['UsuarioController@destroy', $usuario->id], 'method'=>'DELETE'])}}
                  {{ Form::submit('Borrar', ['class'=>'btn btn-sm btn-secondary mr-1']) }}
              {{ Form::close()}}

              {{ link_to_action('UsuarioController@edit', 'Editar', $usuario->id, ['class'=>'btn btn-sm btn-info']) }}
            </div>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@stop

@section('scripts')
<script type="text/javascript" src="{{url('js/usuario.js')}}"></script>
@stop
