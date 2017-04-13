@extends('dashboard')

@section('title_tab', 'Estadísticas' )

@section('title', 'Estadísticas' )

@section('controller_js')
    <script type="text/javascript" src={{ asset("js/controllers/statisticsIndex.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
    <li><a href="/statistics"></a></li>
@endsection

@section('content')
    <div ng-controller="statisticsIndexCtrl">

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
                                    ng-options="subject.subject_name for subject in subjects" id="subject" ng-model="selectedSubject"></select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-2 col-lg-2">
                        <div class="form-group">
                            <label for="filter">Calificación</label>
                            <select ng-model="filter" id="filter" class="form-control" ng-change="updateFilter()">
                                <option value="passed">Aprobados</option>
                                <option value="failed">Reprobados</option>
                                <option value="l_5">5 o menos</option>
                                <option value="e_6">6</option>
                                <option value="e_7">7</option>
                                <option value="e_8">8</option>
                                <option value="e_9">9</option>
                                <option value="e_10">10</option>
                            </select>
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
