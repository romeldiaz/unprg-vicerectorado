@extends('layouts.app')


@section('content')

<div class="row">
  <div class="col col-sm-12">
      <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#responsables" role="tab" aria-controls="responsables" aria-selected="false">Responsables</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#metas" role="tab" aria-controls="metas" aria-selected="false">Metas</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

          {{ Form::hidden('actividad_id', $actividad->id) }}<!--Para capturara la actividad desde el script -->


          <div class="row">
            <div class="col col-sm-12">
              <div class="progress mb-2">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
              </div>
            </div>

            <div class="col col-sm-12">
              @if($plazo>=0)
                <p class="text-right text-primary">Faltan {{$plazo}} dias para terminar la actividad</p>
              @else
                <p class="text-right text-danger">La actividad lleva {{abs($plazo)}} dias retrasada</p>
              @endif
            </div>

            <div class="col col-sm-12">
              <div class="alert alert-dark" role="alert">
                <p class="lead mb-0">{{ $actividad->nombre }}</p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col col-sm-6">
              <div class="col col-sm-12">
                <label for="actividad_estado">Estado:</label>
                <span class="badge badge-pill badge-info p-1">En proceso</span>
              </div>

              <div class="col col-sm-12">
                <table class="table table-sm mt-3">
                  <thead>
                    <tr>
                      <th>Presupuesto</th>
                      <th>Gastos</th>
                      <th>Diferencia</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $actividad->presupuesto}}</td>
                      <td>3450.00</td>
                      <td>945.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col col-sm-12">
                <div class="row">
                  <div class="col col-sm-6">
                    <div class="card border-secondary mb-3" style="max-width: 18rem;">
                      <div class="card-header py-1">Resolucion</div>
                      <div class="card-body py-2">
                        <p class="card-title">N°: {{ $actividad->numero_resolucion}}</p>
                        <p class="card-text">Fecha: {{ $actividad->fecha_resolucion}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col col-sm-6">
                    <div class="card border-secondary mb-3" style="max-width: 18rem;">
                      <div class="card-header py-1">Acta</div>
                      <div class="card-body py-2">
                        <p class="card-title">N°: {{ $actividad->fecha_acta }}</p>
                        <p class="card-text">{{ $actividad->descripcion_acta }}</p>
                      </div>
                    </div>
                  </div>
                </div>



              </div>
            </div>

            <div class="col col-sm-6">
              Creador:
              <ul>
                <li>{{ $creador->nombres }}</li>
              </ul>
              Monitor:
              <ul>
                <li>{{ $monitor->nombres }}</li>
              </ul>
              Responsables:
              <ul>
                @foreach($responsables as $key=> $responsable)
                  <li>{{ $responsable->nombres }} <a href="javascript: show_info_user({{$responsable->id}})">Ver</a></li>
                @endforeach
              </ul>


              <!--<div class="modal fade show" id="modalUserInfo" style="display: block;display: block; padding-right: 17px;" tabindex="-1" role="dialog">-->
              <div class="modal fade" id="modalUserInfo" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><span class="icon-user mr-1"></span>Usuario</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body pb-0">
                      <div class="row">
                        <div class="col col-sm-12">
                          <div class="text-center">
                            <img src="{{url('images/user.png')}}" style="width:150px;" alt="imagen de usuario" class="img-thumbnail rounded-circle">
                          </div>
                        </div>
                        <div class="col col-sm-12">
                          <table class="table table-sm mt-2">
                            <tbody>
                              <tr>
                                <td>Nombres:</td>
                                <td><label id="user-nombres"></label></td>
                              </tr>
                              <tr>
                                <td>Apellido Paterno:</td>
                                <td><label id="user-paterno"></label></div></td>
                              </tr>
                              <tr>
                                <td>Apellido Materno:</td>
                                <td><label id="user-materno"></label></td>
                              </tr>
                              <tr>
                                <td>Oficina:</td>
                                <td><label id="user-oficina"></label></td>
                              </tr>
                              <tr>
                                <td>Actividades:</td>
                                <td><label id="user-actividades"></label> <span class="icon-hammer text-info"></span></td>
                              </tr>
                              <tr>
                                <td>Metas:</td>
                                <td><label id="user-metas"></label> <span class="icon-flag text-danger"></span></td>
                              </tr>
                              <tr>
                                <td>Puntaje:</td>
                                <td><label id="user-puntaje"></label> <span class="icon-star-full text-warning"></span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>
              </div>

            </div>

          </div>


        </div>
        <div class="tab-pane fade" id="responsables" role="tabpanel" aria-labelledby="profile-tab">
          <div class="row">
            <div class="col col-sm-6">
              <div class="form-row">
                <?php
                  $oficinas_options[0] = 'todas';
                  foreach ($oficinas as $key => $oficina) {
                    $oficinas_options[$oficina->id] = $oficina->nombre;
                  }
                 ?>
                <div class="col col-sm-3">
                  {{ Form::select('search_by_oficinas',$oficinas_options, '0', ['class'=>'form-control', 'id'=>'search_by_oficinas'])}}
                </div>
                <div class="col col-sm-9">
                  {{ Form::text('search_word', null, ['class'=>'form-control', 'placeholder'=>'buscar', 'id'=>'search_word']) }}
                </div>
              </div>

              <table class="table table-sm table-hover">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Resultados</th>
                    <th><a href="javascript: seleccionar_varios(0)" class="btn btn-sm btn-secondary"><span id="span_0" class="icon-plus"></span></a></th>
                  </tr>
                </thead>
                <tbody id="search_results">

                </tbody>
              </table>

            </div>

            <div class="col col-sm-6">
              {{ Form::open(['action'=>['ResponsableController@store'], 'method'=>'POST']) }}
                {{ Form::hidden('actividad_id', $actividad->id)}}

                <table class="table table-sm table-hover">
                  <thead>
                    <tr>
                      <th>N</th>
                      <th>Nombre</th>
                      <th>
                        <div class="d-flex flex-row-reverse">
                          {{ Form::submit('Guardar lista', ['class'=>'btn btn-sm btn-primary']) }}
                        </div>
                      </th>
                    </tr>
                  </thead>
                  <tbody id="responsables_selected">
                  </tbody>
                </table>
              {{ Form::close() }}


            </div>
          </div>

        </div>
        <div class="tab-pane fade" id="metas" role="tabpanel" aria-labelledby="contact-tab">Metas</div>
      </div>
  </div>
</div>

@endsection

@section('script')
  <script src="{{ url('js/actividad_show.js') }}"></script>
@endsection
