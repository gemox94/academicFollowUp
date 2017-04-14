@extends('layouts.app')

@section('title_tab', 'Anuncios para profesores' )

@section('title', 'Anuncios' )

@section('controller_js')
<script type="text/javascript" src={{ asset("js/controllers/advertisements.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
<li><a href="/coordinator/advertisements">Anuncios</a></li>
@endsection

@section('content')
<div ng-controller="CoordinatorAdvertisementsCtrl">

    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Anuncios</h3>
            </div>

            <uib-alert ng-repeat="alert in alerts"
                   dismiss-on-timeout="5000"
                   type="@{{alert.type}}"
                   close="alertService.closeAlert($index)">
                   @{{alert.msg}}
            </uib-alert>

            <form class="form-horizontal" name="advertisements" id="advertisements">
                <div class="panel-body tab-content" id="print-section">
                    <div class="tab-pane active" id="datos">

                        <div class="row">
                            <a class="btn btn-primary" href="#" ng-click="advertisementModal()">
                                <span class="fa fa-plus"></span>
                                Nuevo Anuncio
                            </a>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped row-border hover">
                                    <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Mensaje</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="advertisement in advertisements">
                                            <td>
                                                @{{ advertisement.title }}
                                            </td>
                                            <td>
                                                @{{ advertisement.message }}
                                            </td>
                                            <td>
                                               <i ng-click="advertisementModal(advertisement)" class="btn btn-primary fa fa-pencil-square-o"></i>
                                            </td>
                                            <td>
                                               <i mwl-confirm
                                                  on-confirm="deleteAdvertisement(advertisement)"
                                                  confirm-text="Eliminar"
                                                  cancel-text="Cancelar"
                                                  title="Eliminar anuncio"
                                                  message="¿Desea eliminar el anuncio?"
                                                  confirm-button-type="danger"
                                                  placement="right"
                                                  class="btn btn-danger fa fa-times">
                                               </i>
                                            </td>
                                        </tr>
                                    </tbody>
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
