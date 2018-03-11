{{ Form::model($gasto, ['action'=>['GastoController@update', $gasto->id], 'method'=>'PUT']) }}
  {{ Form::hidden('meta_id', $meta->id) }}
  <div class="form-group">
    {{ Form::textarea('descripcion', null, ['class'=>'form-control', 'rows'=>'5', 'placeholder'=>'Descripcion']) }}
  </div>

  <div class="form-group">
    {{ Form::text('monto', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Monto']) }}
  </div>

  <div class="form-group">
    {{ Form::text('numero', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Numero']) }}
  </div>

  <div class="form-group">
    {{ Form::date('fecha', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Fecha']) }}
  </div>

  <div class="form-group">
    {{ Form::text('tipo', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Tipo']) }}
  </div>

  <div class="form-group">
    <?php
      $opciones = array();
      foreach($documentos as $documento){
        $opciones[$documento['id']] = $documento['nombre'];
      }
     ?>
    {!! Form::select('documento_id',$opciones,null,['class'=>'form-control form-control-sm', 'placeholder'=>'Documento']) !!}
  </div>
  <div class="d-flex flex-row-reverse">
    <div class="form-inline">
      {{ link_to('gastos/create/'.$meta->id, 'Cancelar', ['class'=>'btn btn-sm btn-secondary mr-1'])}}
      {{ Form::submit('Editar', ['class'=>'btn btn-sm btn-success']) }}
    </div>
  </div>

{{ Form::close()}}
