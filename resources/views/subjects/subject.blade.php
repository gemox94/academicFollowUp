@extends('layouts.app')

@section('title_tab', 'Materias' )

@section('title', $title )

@section('controller_js')
<script type="text/javascript" src={{ asset("js/controllers/subjects.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
<li><a href="/subjects">Materias</a></li>
@endsection


@section('content')

    <script type="text/javascript">
        window.subject_id = {{ $subject_id }}
    </script>

    <div class="panel panel-default tabs" ng-controller="SubjectCtrl">

        <uib-alert ng-repeat="alert in alerts"
               dismiss-on-timeout="5000"
               type="@{{alert.type}}"
               close="alertService.closeAlert($index)">
               @{{alert.msg}}
        </uib-alert>

        <form class="form-horizontal" name="subject_form" ng-submit="saveSubject()" id="subject_form">
                <div class="panel-body tab-content" id="print-section">
                    <div class="tab-pane active" id="datos">

                        <div>
                            <h4>
                              Datos de la Materia <span ng-if="subject.id">@{{ subject.name }}</span>
                            </h4>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Nombre*</label>
                                <div class="col-md-6 col-xs-12">
                                      <div class="input-group">
                                          <input ng-if="subject.id" class="form-control" ng-model="subject.name" type="text" readonly>

                                          <select ng-if="!subject.id" class="lot_select"
                                                  ng-options="subject_name.name for subject_name in subject_names"
                                                  ng-model="selectedSubject.data">
                                          </select>

                                          <span class="input-group-addon">
                                              <span class="fa fa-book"></span>
                                          </span>
                                      </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Clave*</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model="subject.key" required>
                                        <span class="input-group-addon">
                                            <span class="fa fa-key"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Sección*</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model="subject.section" required>
                                        <span class="input-group-addon">
                                            <span class="fa fa-puzzle-piece"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">NRC*</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model="subject.nrc" required>
                                        <span class="input-group-addon">
                                            <span class="fa fa-hashtag"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Periodo*</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model="subject.period" required>
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Salón y Horario*</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model="subject.schedule_json" required>
                                        <span class="input-group-addon">
                                            <span class="fa fa-clock-o"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <button ng-if="!lot.id" class="btn btn-primary">
                        Guardar <span class="fa fa-lock"></span>
                    </button>

                </div>
        </form>
    </div>

    <script type="text/ng-template" id="collector_modal.html">
        <div class="modal-header">
            <h3 class="modal-title">Agregar Acopiador</h3>
        </div>
        <div class="modal-body contract-modal">
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Nombre" ng-model="collector.name">
            </div>
            <div class="form-group">
              <input class="form-control" type="number" placeholder="Teléfono" ng-model="collector.phone">
            </div>
        </div>
        <div class="modal-footer">
            <p>
              <button class="btn btn-primary" type="button" ng-click="ok()">Agregar</button>
              <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
            </p>
        </div>
    </script>


    <script type="text/ng-template" id="producer_modal.html">
        <div class="modal-header">
            <h3 class="modal-title">Agregar Productor</h3>
        </div>
        <div class="modal-body contract-modal">
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Nombre" ng-model="producer.name">
            </div>
            <div class="form-group">
              <input class="form-control" type="number" placeholder="Teléfono" ng-model="producer.phone">
            </div>
        </div>
        <div class="modal-footer">
            <p>
              <button class="btn btn-primary" type="button" ng-click="ok()">Agregar</button>
              <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
            </p>
        </div>
    </script>


    <script type="text/ng-template" id="orchard_modal.html">
        <div class="modal-header">
            <h3 class="modal-title">Agregar Huerta</h3>
        </div>
        <div class="modal-body contract-modal">
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Nombre" ng-model="orchard.name">
            </div>
            <div class="form-group">
              <input class="" type="radio" name="orchard_type" ng-model="orchard.type" value="organic"> Organica
              <input class="" type="radio" name="orchard_type" ng-model="orchard.type" value="traditional"> Tradicional
            </div>
        </div>
        <div class="modal-footer">
            <p>
              <button class="btn btn-primary" type="button" ng-click="ok()">Agregar</button>
              <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
            </p>
        </div>
    </script>

@endsection
