@extends('layouts.app')

@section('title_tab', 'Programación Académica')

@section('title', 'Programación Académica')

@section('controller_js')
<script type="text/javascript" src={{ asset("js/controllers/academicProgrammation.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
<li><a href="/coordinator/academicProgrammation">Programación Académica</a></li>
@endsection

@section('content')
<div ng-controller="AcademicProgramamtionCtrl">

    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Materias</h3>
            </div>

            <uib-alert ng-repeat="alert in alerts"
                   dismiss-on-timeout="5000"
                   type="@{{alert.type}}"
                   close="alertService.closeAlert($index)">
                   @{{alert.msg}}
            </uib-alert>

            <form class="form-horizontal" name="subjects" id="subjects">
                <div class="panel-body tab-content" id="print-section">
                    <div class="tab-pane active" id="datos">

                        <div class="row">
                            <!--<a class="btn btn-primary" href="#" ng-click="advertisementModal()">
                                <span class="fa fa-plus"></span>
                                Nuevo Anuncio
                            </a>
                            <hr>-->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table datatable="ng" dt-options="dtOptions" dt-columns="dtColumns" class="table table-striped row-border hover">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>NRC</th>
                                            <th>Sección</th>
                                            <th>Clave</th>
                                            <th>Horario</th>
                                            <th>Periodo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="subject in subjects">
                                            <td>
                                                @{{ subject.name }}
                                            </td>
                                            <td>
                                                @{{ subject.nrc }}
                                            </td>
                                            <td>
                                                @{{ subject.section }}
                                            </td>
                                            <td>
                                                @{{ subject.key }}
                                            </td>
                                            <td>
                                                @{{ subject.schedule_json }}
                                            </td>
                                            <td>
                                                @{{ subject.period.period }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>NRC</th>
                                            <th>Sección</th>
                                            <th>Clave</th>
                                            <th>Horario</th>
                                            <th>Periodo</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
