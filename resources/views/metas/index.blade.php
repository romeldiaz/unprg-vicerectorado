@extends('layouts.dashPanel')

@section('content')
  <div class="row">
    <div class="col col-sm-12">
      <div class="alert alert-dark" role="alert">
        <h3>Actividad:: {{$actividad->nombre}}</h3>
        <a href="{{url('actividades/'.$actividad->id)}}"><span class="badge badge-info">Ver</span></a>
      </div>

    </div>
  </div>
  <div class="row">
    <div class="col col-sm-12 col-md-4">
      @include('partials.myMessage')

      @if(isset($meta))
        @include('metas.edit')
      @else
        @include('metas.create')
      @endif
    </div>

    <div class="col col-sm-12 col-md-8">
      <div class="table-responsive">
        <table class="table table-hover table-sm ">
          <thead>
            <tr>
              <th>N°</th>
              <th>Meta</th>
              <th>
                <div class="d-flex flex-row-reverse">
                  <div class="form-inline">
                    {{ Link_to('actividades/'.$actividad->id.'/metas/create', 'Nueva', ['class'=>'btn btn-sm btn-danger'])}}
                  </div>
                </div>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php $num=0; ?>
            @foreach($metas as $key => $meta)
            <?php $num++; ?>
            <tr>
              <td>{{$meta->id}}</td>
              <td>{{$meta->nombre}}</td>
              <td>
                <div class="d-flex flex-row-reverse">
                  <div class="form-inline ">
                    <!--<a href="javascript: show({{$meta->id}})" class="btn btn-sm btn-outline-primary mr-1">Ver</a>-->
                    {{ link_to_action('MetaController@show', 'Ver', $meta->id, ['class'=>'btn btn-sm btn-outline-primary mr-1']) }}
                    {{ link_to('actividades/'.$actividad->id.'/metas/'.$meta->id.'/edit', 'editar', ['class'=>'btn btn-sm btn-success mr-1']) }}
                    {{ Form::open(['url'=>['actividades/'.$actividad->id.'/metas/'.$meta->id.'/destroy'], 'method'=>'DELETE']) }}
                      {{ Form::submit('Borrar', ['class'=>'btn btn-sm btn-secondary']) }}
                    {{ Form::close()}}

                    {{ Form::open(['action'=>['GastoController@create'], 'method'=>'POST']) }}
                      {{ Form::hidden('meta_id', 48)}}
                      <button type="submit" name="button">Gastos</button>
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

@section('scripts')
  <script type="text/javascript" src="{{url('js/meta.js')}}"></script>
@stop
