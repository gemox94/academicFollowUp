@extends('layouts.app')

@section('title_tab', 'Materias' )

@section('title', 'Materias' )

@section('controller_js')

<script type="text/javascript" src="{{asset('js/controllers/studentSubjects.js')}}"></script>

@endsection

@section('extra_css')
    
@endsection

@section('breadcrumb')
<li><a href="/student/subjects">Materias</a></li>
@endsection

@section('content')
<div class="eq-height" ng-controller="studentSubjectsCtrl">

    <script type="text/ng-template" id="ShowGradesModal.html">
        <div class="modal-header">
            <h3 class="modal-title">Calificaciones</h3>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
            <p>
                <button class="btn btn-primary" type="button" ng-click="ok()">Cerrar</button>
            </p>
        </div>
    </script>



    <div class="col-sm-4 eq-box-sm">
        <div class="panel">
            <div class="panel-body">
                <div>
                    <uib-alert ng-repeat="alert in alerts"
                               dismiss-on-timeout="5000"
                               type="@{{alert.type}}"
                               close="alertService.closeAlert($index)">
                               @{{alert.msg}}
                    </uib-alert>

                    <table  class="table table-hover">
                        <thead>
                        <tr>
                            <th>Materia</th>
                            <th>NRC</th>
                            <th>Salon/Horario</th>
                            <th>Sección</th>
                            <th>Periodo</th>
                            <th>Calificación Final</th>
                            <th>Detalle de calificaciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="subject in subjects">
                                <td>@{{subject.name}}</td>
                                <td>@{{subject.nrc}}</td>
                                <td>@{{subject.schedule}}</td>
                                <td>@{{subject.section}}</td>
                                <td>@{{subject.period.period}}</td>
                                <td>@{{subject.pivot.final_grade}}</td>
                                <td>
                                    <button class="btn btn-primary"
                                            ng-click="showGrades(subject)">
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
