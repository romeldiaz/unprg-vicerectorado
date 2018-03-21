@extends('layouts.app')

@section('content')
  Gestion de  oficinas

  <div class="row">
    <div class="col col-sm-12 col-md-4 mb-5">
      @if(isset($oficina))
        @include('oficinas.edit')
      @else
        @include('oficinas.create')
      @endif
    </div>
    <div class="col col-sm-12 col-md-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Buscar</div>
        </div>
        <input type="text" id="search_word" class="form-control form-control-sm" placeholder="Nombre de Oficina">
      </div>


      <table class="table table-sm">
        <thead>
            <tr>
            <th>N°</th>
            <th>Nombre</th>
            <td>
              <div class="d-flex flex-row-reverse">
                {{ Link_to('oficinas', 'Nueva', ['class'=>'btn btn-sm btn-info']) }}
              </div>
            </td>
          </tr>
        </thead>
        <tbody id="table-body-oficinas">
            @foreach($oficinas as $key => $oficina)
              <tr>
                <td>{{ $oficina->id }}</td>
                <td>{{ $oficina->nombre }}</td>
                <td>
                  <div class="d-flex flex-row-reverse">
                    {{ Form::open(['action'=>['OficinaController@destroy', $oficina->id], 'method'=>'DELETE']) }}
                      <button type="submit" class="btn btn-sm btn-secondary">Eliminar</button>
                    {{ Form::close() }}

                    {{ link_to_action('OficinaController@edit', 'Editar', $oficina->id, ['class'=>'btn btn-sm btn-success mr-1'])}}
                  </div>
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection

@section('script')
  <script src="{{ url('js/oficina.js') }}"></script>
@endsection
