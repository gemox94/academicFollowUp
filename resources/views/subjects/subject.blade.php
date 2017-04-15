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

        <form class="form-horizontal" name="subject_form" ng-submit="saveSubject()" id="subject_form">
            <div class="panel-body tab-content" id="print-section">
                <div class="tab-pane active" id="datos">

                    <div>
                        <h4>
                          Datos de la Materia <span ng-if="subject.id">@{{ subject.name }}</span>
                        </h4>

                        <uib-alert ng-repeat="alert in alerts"
                                dismiss-on-timeout="5000"
                                type="@{{alert.type}}"
                                close="alertService.closeAlert($index)">
                                @{{alert.msg}}
                        </uib-alert>

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
                                    <input type="text" class="form-control" 
                                    ng-model="subject.period.period" readonly>
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
                <button class="btn btn-primary">
                    Guardar <span class="fa fa-lock"></span>
                </button>
            </div>
        </form>

        <div ng-if="subject.id" class="col-md-12">
            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Criterios de evaluacion</h3>
                </div>

                <uib-alert ng-repeat="alert in alerts"
                       dismiss-on-timeout="5000"
                       type="@{{alert.type}}"
                       close="alertService.closeAlert($index)">
                       @{{alert.msg}}
                </uib-alert>

                <form class="form-horizontal" name="subject_form3" ng-submit="saveEvaluations()" id="subject_form3">
                    <div class="panel-body tab-content" id="print-section" >
                        <div class="tab-pane active" id="evaluations">

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group" ng-repeat="evaluation in subject.evaluations">
                                        <label class="col-md-3 col-xs-12 control-label">
                                            @{{ evaluation.name }}
                                        </label>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="input-group">
                                                <input type="number" class="form-control" ng-model="evaluation.percentage">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-percent"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <button class="btn btn-primary">
                            Guardar <span class="fa fa-lock"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>



        <div ng-if="subject.id" class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Anuncios de la materia</h3>
                </div>

                <uib-alert ng-repeat="alert in alerts"
                       dismiss-on-timeout="5000"
                       type="@{{alert.type}}"
                       close="alertService.closeAlert($index)">
                       @{{alert.msg}}
                </uib-alert>

                <form class="form-horizontal" name="subject_form2" id="subject_form2">
                    <div class="panel-body tab-content" id="print-section" >
                        <div class="tab-pane active" id="datos">

                            <div class="row">
                                <a class="btn btn-primary" href="#" ng-click="advertisementModal()">
                                    <span class="fa fa-plus"></span>
                                    Nuevo Anuncio
                                </a>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped row-border hover">
                                        <thead>
                                            <tr>
                                                <th>Título</th>
                                                <th>Mensaje</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="advertisement in subject.advertisements">
                                                <td>
                                                    @{{ advertisement.title }}
                                                </td>
                                                <td>
                                                    @{{ advertisement.message }}
                                                </td>
                                                <td>
                                                   <i ng-click="advertisementModal(advertisement)" class="btn btn-primary fa fa-pencil-square-o"></i>
                                                </td>
                                                <td>
                                                   <i mwl-confirm
                                                      on-confirm="deleteAdvertisement(advertisement)"
                                                      confirm-text="Eliminar"
                                                      cancel-text="Cancelar"
                                                      title="Eliminar anuncio"
                                                      message="¿Desea eliminar el anuncio?"
                                                      confirm-button-type="danger"
                                                      placement="right"
                                                      class="btn btn-danger fa fa-times">
                                                   </i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>



        <div ng-if="subject.id" class="col-md-12">
            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Alumnos de la materia</h3>
                </div>

                <uib-alert ng-repeat="alert in alerts"
                       dismiss-on-timeout="5000"
                       type="@{{alert.type}}"
                       close="alertService.closeAlert($index)">
                       @{{alert.msg}}
                </uib-alert>

                <form class="form-horizontal" name="subject_form2" id="subject_form2">
                    <div class="panel-body tab-content" id="print-section" >
                        <div class="tab-pane active" id="datos">

                            <div class="row">
                                <!--<a class="btn btn-success" href="/subjects/@{{subject.id}}/evaluateStudents">
                                    <span class="fa fa-plus"></span>
                                    Calificar Alumnos
                                </a>-->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped row-border hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Matrícula</th>
                                                <th>Promedio Final</th>
                                                <th>Calificar</th>
                                                <th>Historial</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="student in subject.students">
                                                <td>
                                                    @{{ student.name }}
                                                </td>
                                                <td>
                                                    @{{ student.key }}
                                                </td>
                                                <td>
                                                    @{{ student.pivot.final_grade }}
                                                </td>
                                                <td>
                                                   <i ng-click="editEvaluations(student)" class="btn btn-primary fa fa-pencil-square-o"></i>
                                                </td>
                                                <td>
                                                    <a href="/students/@{{ student.id }}/cardex" class="btn btn-default fa fa-clock-o"></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>


    <script type="text/ng-template" id="evaluations_modal.html">
        <div class="modal-header">
            <h3 class="modal-title">Evaluaciones</h3>
        </div>
        <div class="modal-body contract-modal">

            <div class="row" ng-repeat="evaluation in student.evaluationsOfSubject">
                <div class="form-group">
                    <label class="col-md-4 col-xs-12 control-label evaluationNameLabel">
                        @{{ evaluation.name }}
                    </label>
                    <div class="col-md-4 col-xs-12">
                        <div class="input-group">
                            <input type="number" class="form-control" ng-model="evaluation.pivot.grade">
                            <span class="input-group-addon">
                                <span class="fa fa-sort-numeric-desc"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <p>
              <button class="btn btn-primary" type="button" ng-click="ok()">Guardar</button>
              <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
            </p>
        </div>
    </script>


    <script type="text/ng-template" id="advertisement_modal.html">
        <div class="modal-header">
            <h3 class="modal-title">Anuncio</h3>
        </div>
        <div class="modal-body contract-modal">

            <div class="row">
                <div class="form-group">
                    <label class="col-md-4 col-xs-12 control-label">
                        Título
                    </label>
                    <div class="col-md-8 col-xs-12">
                        <input type="text" class="form-control" ng-model="advertisement.title">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="form-group">
                    <label class="col-md-4 col-xs-12 control-label">
                        Mensaje
                    </label>
                    <div class="col-md-8 col-xs-12">
                        <textarea class="form-control" ng-model="advertisement.message"></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <p>
              <button class="btn btn-primary" type="button" ng-click="ok()">Guardar</button>
              <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
            </p>
        </div>
    </script>

@endsection
