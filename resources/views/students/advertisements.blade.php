@extends('layouts.app')

@section('title_tab', 'Anuncios del estudiante' )

@section('title', 'Anuncios' )

@section('controller_js')
<script type="text/javascript" src="{{ asset('js/controllers/advertisements.js')}}"></script>
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
                        class="list-group-item list-item-advertisement"
                        ng-class="'list-group-item-'+advertisement.color"
                        ng-click="openAdvertisement(advertisement)">
                        @{{ advertisement.created_at | date : "dd / MMM / yyyy" }} - @{{ advertisement.title }}
                    </a>
                </div>
            </div>
        </div>
    </div>



    <script type="text/ng-template" id="advertisement_modal.html">
        <div class="modal-header">
            <h3 class="modal-title">Información del anuncio</h3>
        </div>
        <div class="modal-body">
            <h4 class="">
                @{{ advertisement.title }}
            </h4>
            <p>
                @{{ advertisement.message }}
            </p>
            <hr>
            <p>
                @{{ advertisement.created_at | date : "dd / MMM / yyyy" }}
            </p>
        </div>
        <div class="modal-footer">
            <p>
              <button class="btn btn-primary" type="button" ng-click="ok()">Cerrar</button>
            </p>
        </div>
    </script>

</div>
@endsection
