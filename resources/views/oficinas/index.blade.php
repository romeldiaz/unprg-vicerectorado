@extends('layouts.dashPanel')

@section('content')

<div class="row">
  <div class="col col-sm-12 col-md-4">
    @if(isset($oficina))
      @include('oficinas.edit')
    @else
      @include('oficinas.create')
    @endif
  </div>

  <div class="col col-sm-12 col-md-8">
    <div class="table-responsive">
      <table class="table table-hover table-sm ">
        <thead>
          <tr>
            <th>N°</th>
            <th>Nombre</th>
            <th>
              <div class="d-flex flex-row-reverse">
                <div class="form-inline">
                  {{ Link_to('oficinas', 'Nueva', ['class'=>'btn btn-sm btn-danger'])}}
                </div>
              </div>


            </th>
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
              <div class="d-flex flex-row-reverse">
                <div class="form-inline ">
                  {{ link_to_action('OficinaController@edit', 'Editar', $oficina->id, ['class'=>'btn btn-sm btn-success mr-1']) }}

                  {{ Form::open(['action'=>['OficinaController@destroy', $oficina->id], 'method'=>'DELETE']) }}
                    {{ Form::submit('Borrar', ['class'=>'btn btn-sm btn-secondary']) }}
                  {{ Form::close()}}
                </div>
              </div>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>


@stop
