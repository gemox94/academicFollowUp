@extends('dashboard')

@section('title_tab', 'Alumnos' )

@section('title', 'Mis alumnos' )

@section('controller_js')
    <script type="text/javascript" src={{ asset("js/controllers/teacherStudentIndex.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
    <li><a href="/teacher-students">Alumnos</a></li>
@endsection

@section('content')
<div ng-controller="teacherStudentIndexCtrl">

    <div class="eq-height">
        <div class="col-sm-4 eq-box-sm">
            <div class="panel">
                <div class="panel-body">
                    <div>
                        <a class="btn btn-primary" href="/subjects/create">
                            <span class="fa fa-plus"></span>
                            Nueva Materia
                        </a>
                    </div>
                    <br>

                    <uib-alert ng-repeat="alert in alerts"
                               dismiss-on-timeout="5000"
                               type="@{{alert.type}}"
                               close="alertService.closeAlert($index)">
                        @{{alert.msg}}
                    </uib-alert>

                    <table datatable="ng" class="table table-striped row-border hover">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>NRC</th>
                            <th>Periodo</th>
                            <th>Clave</th>
                            <th>Sección</th>
                            <th>Salón y horario</th>
                            <th>Información</th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="subject in subjects">
                            <td>@{{ subject.name }}</td>
                            <td>@{{ subject.nrc }}</td>
                            <td>@{{ subject.period }}</td>
                            <td>@{{ subject.key }}</td>
                            <td>@{{ subject.section }}</td>
                            <td>@{{ subject.schedule_json }}</td>
                            <td>
                                <a href="/subjects/@{{ subject.id }}" class="btn btn-primary">
                                    <i class="fa fa-info-circle"></i>
                                    Ver info
                                </a>
                            </td>
                            <td>
                                <button ng-click="deleteSubject(subject, $index)" class="btn btn-danger">
                                    <i class="fa fa-times"></i>

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