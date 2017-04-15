@extends('dashboard')

@section('title_tab', 'Estadísticas')

@section('title', 'Estadísticas por materia')

@section('controller_js')
    <script type="text/javascript" src={{ asset("js/controllers/statisticsIndex.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
<li><a href="/statistics/subject"></a></li>
@endsection

@section('content')
    <div ng-controller="StatisticsSubjectCtrl">

        <div class="eq-height">
            <div class="col-sm-4 eq-box-sm">

                <uib-alert ng-repeat="alert in alerts"
                           dismiss-on-timeout="5000"
                           type="@{{alert.type}}"
                           close="alertService.closeAlert($index)">
                    @{{alert.msg}}
                </uib-alert>

                <div class="row">

                    <div class="col-sm-12 col-md-2 col-lg-2">
                        <div class="form-group">
                            <label for="subject">Materias</label>
                            <select class="form-control"
                                    ng-change="updateFilter()"
                                    ng-options="subject.subject_name for subject in subjects" id="subject" ng-model="selectedSubject"></select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-2 col-lg-2">
                        <div class="form-group">
                            <label for="">Limpiar</label>
                            <button class="btn btn-primary form-control" ng-click="clearPlot()"><span class="fa fa-eraser"></span></button>
                        </div>
                    </div>

                </div>
                <div class="panel">
                    <div class="panel-body">

                        <div id="plot" style="width:90%;height:250px;"></div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
