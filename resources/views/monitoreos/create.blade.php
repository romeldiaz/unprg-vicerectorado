{{ Form::open(['url'=>'monitoreos']) }}
  {{ Form::hidden('meta_id', $meta->id) }}
  <div class="input-group mb-2">
    <div class="input-group-prepend">
      <span class="input-group-text icon-calendar"></span>
    </div>
    {{ Form::date('fecha', $hoy, ['class'=>'form-control']) }}
  </div>

  <div class="form-group">
    {{ Form::textarea('descripcion', null, ['class'=>'form-control', 'placeholder'=>'Descripcion', 'rows'=>'5']) }}
  </div>

  <div class="form-group">
    {{ Form::textarea('observacion', null, ['class'=>'form-control', 'placeholder'=>'Observacion', 'rows'=>'5']) }}
  </div>

  <div class="d-flex flex-row-reverse">
    {{ Form::submit('Guardar', ['class'=>'btn btn-info']) }}
  </div>

{{ Form::close()}}
