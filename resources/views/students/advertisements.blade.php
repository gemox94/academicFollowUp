@extends('layouts.app')

@section('title_tab', 'Anuncios del estudiante' )

@section('title', 'Anuncios' )

@section('controller_js')
<script type="text/javascript" src={{ asset("js/controllers/advertisements.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
<li><a href="/student/advertisements">Anuncios</a></li>
@endsection

@section('content')
<div ng-controller="StudentAdvertisementsCtrl">
    <div class="col-lg-6 eq-box-lg" ng-repeat="subject in subjects">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                    @{{ subject.name }}
                </h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <a  ng-repeat="advertisement in subject.advertisements"
                        class="list-group-item"
                        ng-class="'list-group-item-'+advertisement.color"
                        ng-click="openAdvertisement(advertisement)">
                        @{{ advertisement.title }}
                    </a>
                    <!--<a class="list-group-item list-group-item-success" href="#">Dapibus ac facilisis in</a>
                    <a class="list-group-item list-group-item-info" href="#">Cras sit amet nibh libero</a>
                    <a class="list-group-item list-group-item-warning" href="#">Porta ac consectetur ac</a>
                    <a class="list-group-item list-group-item-danger" href="#">Vestibulum at eros</a>
                    <a class="list-group-item list-group-item-mint" href="#">Dapibus ac facilisis in</a>
                    <a class="list-group-item list-group-item-purple" href="#">Cras sit amet nibh libero</a>
                    <a class="list-group-item list-group-item-pink" href="#">Porta ac consectetur ac</a>
                    <a class="list-group-item list-group-item-dark" href="#">Vestibulum at eros</a>-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
