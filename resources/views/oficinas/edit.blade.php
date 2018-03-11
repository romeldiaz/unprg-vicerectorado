{{ Form::model($oficina, ['action'=>['OficinaController@update', $oficina->id], 'method'=>'PUT']) }}
  <div class="form-group">
    {{ Form::hidden('id',null) }}
    {{ Form::text('nombre', null, ['class'=>'form-control'])}}
  </div>
  <div class="d-flex flex-row-reverse">
    {{ Form::submit('Editar', ['class'=>'btn btn-success'])}}
    {{ Link_to('oficinas', 'Cancelar', ['class'=>'btn btn-secondary mr-2'])}}
  </div>
{{ Form::close()}}
