{{ Form::open(['action'=>['UserController@store'], 'method'=>'POST'])}}
  {{ Form::hidden('page','create') }} <!--Para controlar el script usuario js-->
  {{ Form::hidden('id', 0, ['id'=>'id']) }}
  <div class="form-group">
    {!!Form::text('nombres', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Nombre'])!!}
  </div>
  <div class="form-group">
    {!!Form::text('paterno', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Apellido paterno'])!!}
  </div>
  <div class="form-group">
    {!!Form::text('materno', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Apellido materno'])!!}
  </div>
  <div class="form-group">
    {!!Form::text('cuenta', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Cuenta'])!!}
  </div>
  <div class="form-group">
    {{ Form::password('password', ['class'=>'form-control form-control-sm', 'placeholder'=>'Clave']) }}
  </div>

  <div class="form-group">
    <?php
      $opciones = array();
      foreach($oficinas as $oficina){
        $opciones[$oficina['id']] = $oficina['nombre'];
      }
     ?>
    {!! Form::select('oficina_id',$opciones,null,['class'=>'form-control form-control-sm', 'placeholder'=>'Seleccione una oficina']) !!}
  </div>

  <div class="form-group">
    <div class="form-check">
      {!!Form::checkbox('jefe', null ,false, ['class'=>'form-check-input form-check-input-sm', 'id'=>'jefe', 'disabled'])!!}
      <label for="jefe" class="form-check-label">Establecer usuario como jefe de esta oficina</label>
    </div>
  </div>


  <div class="d-flex flex-row-reverse">
    <div class="form-inline">
      {{ link_to('users','Cancelar',['class'=>'btn btn-sm btn-secondary mr-1']) }}
      {{ Form::submit('Crear', ['class'=>'btn btn-sm btn-info']) }}
    </div>
  </div>


{!! Form::close() !!}
