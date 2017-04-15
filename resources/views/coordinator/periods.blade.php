@extends('layouts.app')

@section('title_tab', 'Periodos' )

@section('title', 'Periodos' )

@section('controller_js')
<script type="text/javascript" src={{ asset("js/controllers/periodsCoordinator.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
<li><a href="/coordinator/advertisements">Periodos</a></li>
@endsection

@section('content')
<div ng-controller="periodsCoordinatorCtrl">

    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Dar de alta periodo</h3>
            </div>

            <uib-alert ng-repeat="alert in alerts"
                   dismiss-on-timeout="5000"
                   type="@{{alert.type}}"
                   close="alertService.closeAlert($index)">
                   @{{alert.msg}}
            </uib-alert>

            <div class="panel-body tab-content">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4">
                        <div class="form-group">
                            <label for="period">Periodo</label>
                            <input type="text" id="period" ng-model="period" class="form-control">
                        </div>
                        <button class="btn btn-primary form-control" ng-click="createPeriod()">Dar de alta</button>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
@endsection
