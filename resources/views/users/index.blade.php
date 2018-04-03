@extends('layouts.main')

@section('sidebar_page_usuarios', 'active')

@section('content')

<div class="row">
  <div class="col col-sm-12 col-md-4">
    <div class="box">
      <div class="box-header with-border">
        <i class="fa fa-user"></i>
        <h3 class="box-title">Usuario</h3>
      </div>
      <div class="box-body">
        @include('partials.myAlertErrors')
        @if(isset($user))
          @include('users.edit')
        @else
          @include('users.create')
        @endif
      </div>
    </div>

  </div>
  <div class="col col-sm-12 col-md-8">
    <div class="box">

      <div class="box-header with-border">
        <div class="box-title">
          Usuarios
          <a href="#" class="btn btn-xs btn-info"><i class="fa fa-user-plus"></i></a>
        </div>
        <div class="box-tools">

          @if(isset($user))
            {{ Form::open(['action'=>['UserController@edit', $user->id], 'method'=>'GET'])}}
          @else
            {{ Form::open(['action'=>'UserController@create', 'method'=>'GET'])}}
          @endif
          <div class="input-group input-group-sm" style="width: 150px;">
            {{ Form::text('search', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'search']) }}
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
          {{ Form::close() }}
        </div>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-sm">
          <thead>
            <tr>
              <th>N°</th>
              <th>Fullname</th>
              <th>Cuenta</th>
              <th>Jefe</th>
              <th>Correo</th>
              <th>Telefono</th>
              <th>Oficina ID</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $num=0; ?>
            @foreach($users as $key => $user)
            <?php $num++; ?>
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->nombres.' '.$user->paterno.' '.$user->materno}}</td>
              <td>{{$user->cuenta}}</td>
              <td>
                @if($user->jefe)
                  <i class="text-success glyphicon glyphicon-king"></i>
                @else
                  <i class="text-info glyphicon glyphicon-pawn"></i>
                @endif
              </td>
              <td>{{$user->correo}}</td>
              <td>{{$user->telefono}}</td>
              <td>{{$user->oficina->nombre}}</td>

              <td>
                {{ Form::open(['action'=>['UserController@destroy', $user->id], 'method'=>'DELETE'])}}
                  <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-xs btn-flat btn-success"><i class="fa fa-pencil"></i></a>
                  <button type="submit" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i></button>
                {{ Form::close()}}
              </td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="box-footer clearfix">
        <div id="mypag" hidden>
          @if($users->total()!=0)
            {{ 'Mostrando del '.$users->firstItem().' al  '.$users->lastItem().' de '.$users->total().' registros'}}
            {{ $users->links('',['class'=>'clearfix']) }}
          @else
            No hay registros
          @endif
        </div>
      </div>

    </div>

  </div>
</div>

@endsection

@section('script')
  <script src="{{ url('js/comun.js') }}"></script>
  <script src="{{ url('js/user.js') }}"></script>
@endsection
