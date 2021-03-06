@extends('dashboard')

@section('title_tab', 'Alumnos' )

@section('title', 'Dar de alumnos' )

@section('controller_js')
    <script type="text/javascript" src={{ asset("js/controllers/teacherStudentCreate.js") }}></script>
@endsection

@section('extra_css')
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
@endsection

@section('breadcrumb')
<!--<li><a href="/teacher_students/create">Dar de Alta</a></li>-->
@endsection

@section('content')
    <!--
    <script src="{{asset('js/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>-->
    <div ng-controller="teacherStudentCreateCtrl">

        <div class="panel panel-default tabs">

            <div class="panel-body tab-content" id="print-section" >
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <uib-alert ng-repeat="alert in alerts"
                                   dismiss-on-timeout="5000"
                                   type="@{{alert.type}}"
                                   close="alertService.closeAlert($index)">
                            @{{alert.msg}}
                        </uib-alert>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="tab-pane active">
                            <div class="form-group">
                                <label for="matricula">Matricula del alumno</label>
                                @if($student_id)
                                    <input type="text" id="matricula" class="form-control" ng-model="matricula" ng-init="matricula={{$student_id}}">
                                @else
                                    <input type="text" id="matricula" class="form-control" ng-model="matricula">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <button type="button" class="btn btn-default" ng-click="searchStudent()" ng-show="!showForm">Ingresar Matricula</button>
                    </div>
                </div>
                <br>
                <div class="row" ng-show="showForm">
                    <div class="col-md-4 col-md-offset-4">
                        <form ng-submit="loadStudent()">
                            <div class="form-group">
                                <label for="student_name">Nombre</label>
                                <input type="text" id="student_name" class="form-control" ng-model="student.name" readonly>
                            </div>

                            <div class="form-group">
                                <label for="student_lastname">Apellidos</label>
                                <input type="text" id="student_lastname" class="form-control" ng-model="student.lastname" readonly>
                            </div>

                            <div class="form-group">
                                <label for="subject">Materia</label>
                                <select name="subject" id="subject" class="form-control" ng-options="sub.name for sub in subjects" ng-model="subject"></select>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

            <div class="panel-footer">
                <button class="btn btn-mint" ng-show="showForm">
                    <span class="fa fa-plus" ng-click="loadStudent()"> Registrar alumno</span>
                </button>
            </div>

        </div>


    </div>

@endsection
