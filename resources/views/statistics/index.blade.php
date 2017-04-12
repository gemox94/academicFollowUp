@extends('dashboard')

@section('title_tab', 'Estadísticas' )

@section('title', 'Todos' )

@section('controller_js')
    <script type="text/javascript" src={{ asset("js/controllers/statisticsIndex.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
    <li><a href="/statistics">Estadísticas</a></li>
@endsection

@section('content')
    <div ng-controller="statisticsIndexCtrl">

        <script type="text/ng-template" id="studentInfoModal.html">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title">@{{ student.name }} @{{ student.lastname }}</h3>
            </div>
            <div class="modal-body" id="modal-body">
                <legend>Materias</legend>
                <table class="table table-bordered" datatable>
                    <thead>
                    <tr>
                        <th>Materia</th>
                        <th>Clave</th>
                        <th>NRC</th>
                        <th>Periodo</th>
                        <th>Salon/Horario</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr ng-repeat="subject in subjects">
                        <td>@{{ subject.name }}</td>
                        <td>@{{ subject.key }}</td>
                        <td>@{{ subject.nrc }}</td>
                        <td>@{{ subject.period }}</td>
                        <td>@{{ subject.schedule_json }}</td>
                    </tr>
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
                <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
            </div>
        </script>

        <div class="eq-height">
            <div class="col-sm-4 eq-box-sm">
                <uib-alert ng-repeat="alert in alerts"
                           dismiss-on-timeout="5000"
                           type="@{{alert.type}}"
                           close="alertService.closeAlert($index)">
                    @{{alert.msg}}
                </uib-alert>
                <div class="panel">
                    <div class="panel-body">
                        <div>
                            <a class="btn btn-success" href="/teacher_students/create">
                                <span class="fa fa-plus"></span>
                                Dar de Alta
                            </a>
                            <a class="btn btn-error" href="/teacher_students/down_page">
                                <span class="fa fa-plus"></span>
                                Dar de Baja
                            </a>
                        </div>
                        <br>

                        <table datatable class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>E-mail</th>
                                <th>Matricula</th>
                                <th>Materias</th>
                                <th>Dar de alta</th>
                                <th>Historial</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{$student->name}} {{$student->lastname}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>{{$student->key}}</td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm btn-info" ng-click="studentInfo({{$student}})">
                                            <span class="fa fa-info-circle"></span>
                                        </button>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm btn-primary">
                                            <span class="fa fa-plus-square"></span>
                                        </button>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="/students/{{$student->id}}/cardex" class="btn btn-default"><span class="fa fa-plus"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
