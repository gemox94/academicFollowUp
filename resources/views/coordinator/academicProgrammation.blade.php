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

            <form class="form-horizontal" name="advertisements" id="advertisements">
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


    <script type="text/ng-template" id="advertisement_modal.html">
        <div class="modal-header">
            <h3 class="modal-title">Anuncio</h3>
        </div>
        <div class="modal-body contract-modal">

            <div class="row">
                <div class="form-group">
                    <label class="col-md-4 col-xs-12 control-label">
                        Título
                    </label>
                    <div class="col-md-8 col-xs-12">
                        <input type="text" class="form-control" ng-model="advertisement.title">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="form-group">
                    <label class="col-md-4 col-xs-12 control-label">
                        Mensaje
                    </label>
                    <div class="col-md-8 col-xs-12">
                        <textarea class="form-control" ng-model="advertisement.message"></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <p>
              <button class="btn btn-primary" type="button" ng-click="ok()">Guardar</button>
              <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
            </p>
        </div>
    </script>

</div>
@endsection
