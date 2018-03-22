@extends('layouts.dashPanel')

@section('content')
  <div class="row">
    <div class="col col-sm-12">


    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Actividades</a></li>
        <li class="breadcrumb-item"><a href="#">Metas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Gastos</li>
      </ol>
    </nav>
    <div class="alert alert-dark" role="alert">
      <h4>Actividad:: {{$meta->nombre}} <a href="#"><span class="badge badge-info">Ver</span></a></h4>

    </div>
    </div>
  </div>
  <div class="row">
    <div class="col col-sm-12 col-md-4">
      @include('partials.myMessage')

      @if(isset($gasto))
        @include('gastos.edit')
      @else
        @include('gastos.create')
      @endif
    </div>

    <div class="col col-sm-12 col-md-8">
      <table class="table table-sm table-hover">
        <thead>
          <tr>
            <th>N</th>
            <th>Descripcion</th>
            <th>Monto</th>
            <th>Numero</th>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>
              <div class="d-flex flex-row-reverse">
                <div class="form-inline">
                  {{ link_to('gastos/create/'.$meta->id, 'Nuevo', ['class'=>'btn btn-sm btn-info mr-1'])}}
                </div>
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($gastos as $key => $gasto)
            <tr>
              <td>{{ $gasto->id }}</td>
              <td>{{ $gasto->descripcion }}</td>
              <td>{{ $gasto->monto }}</td>
              <td>{{ $gasto->numero }}</td>
              <td>{{ $gasto->fecha }}</td>
              <td>{{ $gasto->tipo }}</td>
              <td>
                <div class="d-flex flex-row-reverse">
                  <div class="form-inline">
                    {{ link_to('gastos/edit/'.$meta->id.'/'.$gasto->id, 'Editar', ['class'=>'btn btn-sm btn-success mr-1'])}}

                    {{ Form::open(['action'=>['GastoController@destroy', $gasto->id], 'method'=>'DELETE']) }}
                      {{ Form::submit('Borrar', ['class'=>'btn btn-sm btn-secondary']) }}
                    {{ Form::close() }}
                  </div>
                </div>


              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@stop

@section('scripts')
@stop
