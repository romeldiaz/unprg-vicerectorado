{{ Form::open(['url'=>'oficinas'])}}
  <div class="form-group">
    {{ Form::hidden('id',null) }}
    {{ Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'Nombre de la oficina'])}}
  </div>
  <div class="form-group">
    <div class="d-flex flex-row-reverse">
      {{ Form::submit('Crear', ['class'=>'btn btn-info'])}}
      {{ Link_to('oficinas', 'Cancelar', ['class'=>'btn btn-secondary mr-2'])}}
    </div>

  </div>
{{ Form::close()}}
