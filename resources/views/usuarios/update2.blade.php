<div class="msn">
  @if(count($errors)>0)
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Mensaje!</strong>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
</div>



<form action="{{url('usuario/update')}}" method="post">

  {{csrf_field()}}
  {!!Form::hidden('id', $usuarioU->id)!!}
  <div class="form-group">
    {!!Form::text('nombre', $usuarioU->nombre, ['class'=>'form-control form-control-sm', 'placeholder'=>'Nombre'])!!}
  </div>
  <div class="form-group">
    {!!Form::text('paterno', $usuarioU->paterno, ['class'=>'form-control form-control-sm', 'placeholder'=>'Apellido paterno'])!!}
  </div>
  <div class="form-group">
    {!!Form::text('materno', $usuarioU->materno, ['class'=>'form-control form-control-sm', 'placeholder'=>'Apellido materno'])!!}
  </div>
  <div class="form-group">
    {!!Form::text('cuenta', $usuarioU->cuenta, ['class'=>'form-control form-control-sm', 'placeholder'=>'Cuenta'])!!}
  </div>
  <div class="form-group">
    {!!Form::password('clave', ['class'=>'form-control form-control-sm', 'placeholder'=>'*******'])!!}
  </div>

  <div class="form-group">
    <?php
      $opciones = array();
      foreach($oficinas as $oficina){
        $opciones[$oficina['id']] = $oficina['nombre'];
      }
     ?>
    {!! Form::select('oficina_id',$opciones,$usuarioU->oficina_id,['class'=>'form-control form-control-sm', 'placeholder'=>'Seleccione una oficina']) !!}
  </div>


  <div class="form-check">
    {!!Form::checkbox('jefe', null ,$usuarioU->jefe, ['class'=>'form-check-input form-check-input-sm', 'id'=>'jefe', 'disabled'  ])!!}
    <label for="jefe" class="form-check-label">Establecer usuario como jefe de esta oficina</label>
  </div>

  </select>
  <a class="btn btn-secondary btn-sm" href="{{url('usuario')}}">Cancelar</a>
  <input class="btn btn-info btn-sm" type="submit" value="Editar">
</form>
