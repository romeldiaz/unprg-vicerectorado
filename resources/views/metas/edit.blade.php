{{ Form::model($meta,['action'=>['MetaController@update', $meta->id],'method'=>'PUT'])}}
  {{ Form::hidden('id', null, ['id'=>'id']) }}
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="#meta-tab" data-toggle="tab" >Meta</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#responsable-tab" data-toggle="tab" >Responsable</a>
    </li>
    <li class="nav-item ml-1">
          {{ Form::submit('Editar', ['class'=>'btn btn-success btn-sm nav-link']) }}
    </li>
  </ul>

  <div class="tab-content mt-3">
    <div class="tab-pane fade show active" id="meta-tab">
      {{ Form::hidden('actividad_id', $actividad->id)}}
      {{ Form::hidden('id', $actividad->id)}}
      <div class="form-group">
        {{ Form::text('nombre', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'Nombre']) }}
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text icon-calendar"><label class="ml-1 mb-0">Inicio</label></span>

          </div>
          {{ Form::date('fecha_inicio_esperada', null, ['class'=>'form-control form-control-sm', 'min'=>null]) }}
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text icon-calendar"><label class="ml-1 mb-0 mr-1">Final</label></span>
          </div>
          {{ Form::date('fecha_fin_esperada', null, ['class'=>'form-control form-control-sm', 'min'=>null]) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::textarea('producto', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'producto', 'rows'=>'5']) }}
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text py-0">S/.</span>
          </div>
          {{ Form::text('presupuesto', null, ['class'=>'form-control form-control-sm', 'placeholder'=>'0.00']) }}
        </div>

      </div>
      <div class="form-group">
        {{  Form::select('estado', ['0'=>'Iniciado', '1'=>'En Proceso', '2'=>'Concluido'], '0', ['class'=>'form-control form-control-sm'])}}
      </div>

    </div>

    <div class="tab-pane fade" id="responsable-tab">

      @foreach($responsables as $key => $responsable)
        <?php $state = false ?>
        @foreach($meta_responsables as $key => $meta_responsable)
          @if( $meta_responsable->responsable_id == $responsable->id)
            <?php $state = true ?>
          @endif
        @endforeach
        <div class="form-check">
          {{ Form::checkbox('responsables[]', $responsable->id, $state, ['class'=>'form-check-input', 'id'=>'responsable'.$responsable->id]) }}
          <label for="responsable{{$responsable->id}}">
            {{$responsable->nombre.' '.$responsable->paterno.' '.$responsable->materno}}
          </label>
        </div>
      @endforeach
    </div>
  </div>
{{ Form::close() }}
