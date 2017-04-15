@extends('layouts.app')

@section('title_tab', 'Profesores' )

@section('title', 'Profesores' )

@section('controller_js')

<script type="text/javascript" src="{{asset('js/controllers/studentTeachers.js')}}"></script>

@endsection

@section('extra_css')
    
@endsection

@section('breadcrumb')
<li><a href="/students/teachers">Profesores</a></li>
@endsection

@section('content')
<div class="eq-height" ng-controller="studentTeachersCtrl">
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

                    <table  class="table table-hover" datatable="ng">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Cubículo</th>
                            <th>Teléfono</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="teacher in teachers">
                                <td>@{{teacher.name}} @{{teacher.lastname}}</td>
                                <td>@{{teacher.email}}</td>
                                <td>@{{teacher.cubicle}}</td>
                                <td>@{{teacher.phone}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
