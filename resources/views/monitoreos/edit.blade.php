{{ Form::model($monitoreo, ['action'=>['MonitoreoController@update', $tarea->id], 'method'=>'PUT']) }}
  {{ Form::hidden('meta_id', null) }}
  {{ Form::hidden('meta_id', null) }}
  <div class="input-group mb-2">
    <div class="input-group-prepend">
      <span class="input-group-text icon-calendar"></span>
    </div>
    {{ Form::date('fecha', null, ['class'=>'form-control']) }}
  </div>

  <div class="form-group">
    {{ Form::textarea('descripcion', null, ['class'=>'form-control', 'placeholder'=>'descripcion', 'rows'=>'5']) }}
  </div>

  <div class="form-group">
    {{ Form::textarea('observacion', null, ['class'=>'form-control', 'placeholder'=>'Observacion', 'rows'=>'5']) }}
  </div>

  <div class="d-flex flex-row-reverse">
    {{ Form::submit('Editar', ['class'=>'btn btn-success']) }}
    {{ link_to('monitoreos','Cancelar', ['class'=>'btn btn-secondary mr-2']) }}
  </div>

{{ Form::close()}}
