@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-2">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" href="{{ route('metas.all') }}">Todas</a>
      <a class="list-group-item list-group-item-action" href="{{ route('metas.my') }}">Mis metas</a>
    </div>
    <div class="alert alert-warning mt-3" role="alert">
      En la lista de tu derecha son las metas en las que estas asiganado como responsable, no las puedes eliminar ni editar. Puedes completar los requisitos para estas metas y seleccionar reponsables para que te ayuden a cumplirla!
    </div>
  </div>
  <div class="col-10">
    <table class="table table-hover table-sm">
      <thead>
        <tr>
          <th>N°</th>
          <th>Nombre</th>
          <th>Fecha</th>
          <th>Presupuesto</th>
          {{--  <th>By</th>  --}}
          <th>
            <div class="d-flex flex-row-reverse">
              {{ link_to('metas/create', 'Crear', ['class'=>'btn btn-sm btn-info']) }}
            </div>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php $num=0; ?>
		@foreach($responsables as $responsable)
		@foreach ($responsable->metas as $meta)
        <?php $num++; ?>
        <tr>
          <td>{{$meta->id}}</td>
          <td>{{$meta->nombre}}</td>
          <td>{{ date("d/m/Y", strtotime($meta->fecha_inicio))}}</td>
          <td>{{number_format($meta->presupuesto, 2, '.', ',')}}</td>
          {{--  <td>{{$meta->creador_id}}</td>  --}}
          <td>
            <div class="d-flex flex-row-reverse">
              <div class="form-inline">
				{{--  {{ link_to_action('MetaController@show', 'Ver', $meta->id, ['class'=>'btn btn-sm btn-dark mr-1']) }}  --}}
				{{--  {{ route('meta.show', $meta->id)}}  --}}
              </div>
            </div>
          </td>
		</tr>
		@endforeach
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('script')
  {{--  <script src="{{ url('js/actividad.js') }}"></script>  --}}
@endsection
