@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col col-sm-12 col-md-4">
    @include('partials.myAlertErrors')
    @if(isset($user))
      @include('users.edit')
    @else
      @include('users.create')
    @endif
  </div>
  <div class="col col-sm-12 col-md-8">
    <table class="table table-hover table-sm">
      <thead>
        <tr>
          <th>N°</th>
          <th>Nombres</th>
          <th>Paterno</th>
          <th>Materno</th>
          <th>Cuenta</th>
          <th>Jefe</th>
          <th>Oficina ID</th>
          <th>
            <div class="d-flex flex-row-reverse">
              {{ link_to('users', 'Crear', ['class'=>'btn btn-sm btn-info']) }}
            </div>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php $num=0; ?>
        @foreach($users as $key => $user)
        <?php $num++; ?>
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->nombres}}</td>
          <td>{{$user->paterno}}</td>
          <td>{{$user->materno}}</td>
          <td>{{$user->cuenta}}</td>
          <td>{{$user->jefe}}</td>
          <td>{{$user->oficina_id}}</td>
          <td>
            <div class="d-flex flex-row-reverse">
              <div class="form-inline">
                {{ link_to_action('UserController@edit', 'Editar', $user->id, ['class'=>'btn btn-sm btn-success mr-1']) }}

                {{ Form::open(['action'=>['UserController@destroy', $user->id], 'method'=>'DELETE'])}}
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

@endsection

@section('script')
  <script src="{{ url('js/user.js') }}"></script>
@endsection
