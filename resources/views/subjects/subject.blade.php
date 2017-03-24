@extends('layouts.app')

@section('title_tab', 'Materias' )

@section('title', $title )

@section('controller_js')
<script type="text/javascript" src={{ asset("js/controllers/subjects.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
<li><a href="/subjects">Materias</a></li>
@endsection


@section('content')

    <script type="text/javascript">
        window.lot_id = {{ $subject_id }}
    </script>

    <div class="panel panel-default tabs" ng-controller="SubjectCtrl" >
<!--
        <spinner name="mySpinner" on-loaded="getResource()">
            <div class="modal-dialog">
                <div class="overlay"></div>
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
                <div class="please-wait">Cargando...</div>
            </div>
        </spinner>-->

        <uib-alert ng-repeat="alert in alerts"
               dismiss-on-timeout="5000"
               type="@{{alert.type}}"
               close="alertService.closeAlert($index)">
               @{{alert.msg}}
        </uib-alert>

        <form class="form-horizontal" name="lot_form" ng-submit="saveLot()" id="lot_form">
                <div class="panel-body tab-content" id="print-section" >
                    <div class="tab-pane active" id="datos">

                        <div>
                            <h4>
                              Datos del Lote <span ng-if="lot.id">@{{ lot.number }}</span>
                            </h4>


                            <div class="form-group" ng-if="lot.id">
                                <label class="col-md-3 col-xs-12 control-label">Fecha</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                            <input ng-readonly="lot.id" type="text" class="form-control" datetime="dd-MMM-yyyy" ng-model="lot.created_at" required>
                                            <span class="input-group-addon">
                                                <span class="fa fa-hashtag"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Lote*</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                            <input ng-readonly="lot.id" type="number" class="form-control" ng-model="lot.number" required>
                                            <span class="input-group-addon">
                                                <span class="fa fa-hashtag"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Acopiador*</label>
                                <div class="col-md-6 col-xs-12">
                                      <div class="input-group">
                                          <input ng-if="lot.id" class="form-control" ng-model="lot.collector.name" type="text" readonly>
                                          <select ng-if="!lot.id" class="lot_select"
                                                  ng-options="collector.name for collector in collectors"
                                                  ng-model="lot.collector"
                                                  ng-change="loadProducers()">
                                          </select>
                                          <span class="input-group-addon">
                                              <span class="fa fa-user"></span>
                                          </span>
                                      </div>
                                      <br>
                                      <button ng-if="!lot.id" class="btn btn-success" ng-click="newCollector()">
                                          Nuevo Acopiador <span class="fa fa-plus"></span>
                                      </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Productor*</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input ng-if="lot.id" class="form-control" ng-model="lot.producer.name" type="text" readonly>
                                        <select ng-if="!lot.id" class="lot_select"
                                                ng-options="producer.name for producer in producers"
                                                ng-model="lot.producer"
                                                ng-change="loadOrchards()">
                                        </select>
                                        <span class="input-group-addon">
                                            <span class="fa fa-user"></span>
                                        </span>
                                    </div>
                                    <br>
                                    <button ng-if="lot.collector && !lot.id" class="btn btn-success" ng-click="newProducer()">
                                        Nuevo Productor <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Huerta*</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input ng-if="lot.id" class="form-control" ng-model="lot.orchard.name" type="text" readonly>
                                        <select ng-if="!lot.id" class="lot_select"
                                                ng-options="orchard.name for orchard in orchards"
                                                ng-model="lot.orchard">
                                        </select>
                                        <span class="input-group-addon">
                                            <span class="fa fa-cube"></span>
                                        </span>
                                    </div>
                                    <br>
                                    <button ng-if="lot.producer && !lot.id" class="btn btn-success" ng-click="newOrchard()">
                                        Nueva Huerta <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Precio por kilo*</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input ng-readonly="lot.id" type="number" class="form-control" ng-model="lot.kilo_price" required>
                                        <span class="input-group-addon">
                                            <span class="fa fa-dollar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Costo de Acarreo*</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input ng-readonly="lot.id" type="number" class="form-control" ng-model="lot.carry" required>
                                        <span class="input-group-addon">
                                            <span class="fa fa-dollar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Costo de corte por Kilo*</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input ng-readonly="lot.id" type="number" class="form-control" ng-model="lot.cut_price" required>
                                        <span class="input-group-addon">
                                            <span class="fa fa-dollar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Peso bascula en Kilos*</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input ng-readonly="lot.id" type="number" class="form-control" ng-model="lot.bascule_weight" required>
                                        <span class="input-group-addon">
                                            <span class="fa fa-balance-scale"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">
                                    Fecha aprox de pago*
                                    <br>
                                    Formato: Mes/Dia/Año
                                </label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input ng-if="!lot.id" type="date" ng-model="lot.pay_date" class="form-control" placeholder="mes/dia/año" min="2016-01-01" required>
                                        <input ng-if="lot.id" readonly type="text" class="form-control" datetime="dd-MMM-yyyy" ng-model="lot.pay_date" required>
                                         <!--<div uib-datepicker ng-model="dt" class="well well-sm" datepicker-options="options"></div>-->
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div ng-if="!lot.id">
                                <hr>
                                <h4>Calibres y Porcentajes</h4>

                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <table class="table table-striped row-border hover">
                                        <thead>
                                        <tr>
                                            <th>Calibre</th>
                                            <th>Porcentaje Total %</th>
                                            <th>Calidad A %</th>
                                            <th>Calidad B %</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="caliber in calibers">
                                            <td>
                                                <span class="label label-table label-success">
                                                    @{{ caliber.name }}
                                                </span>
                                            </td>
                                            <td>
                                                @{{ caliber.percentage }}
                                            </td>
                                            <td>
                                                @{{ caliber.a_percentage }}
                                            </td>
                                            <td>
                                                @{{ caliber.b_percentage }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div ng-if="lot.id">
                                <hr>
                                <h4>Datos Generados</h4>

                                <div class="form-group" ng-if="lot.id">
                                    <label class="col-md-3 col-xs-12 control-label">Precio Real por Kilo ($)</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <input readonly type="number" class="form-control" ng-model="lot.real_price_per_kg" required>
                                            <span class="input-group-addon">
                                                <span class="fa fa-dollar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" ng-if="lot.id">
                                    <label class="col-md-3 col-xs-12 control-label">Precio Real por Caja ($)</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <input readonly type="number" class="form-control" ng-model="lot.real_price_per_box" required>
                                            <span class="input-group-addon">
                                                <span class="fa fa-dollar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" ng-if="lot.id">
                                    <label class="col-md-3 col-xs-12 control-label">Peso útil estimado (KG)</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <input readonly type="number" class="form-control" ng-model="lot.useful_weight" required>
                                            <span class="input-group-addon">
                                                <span class="fa fa-balance-scale"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" ng-if="lot.id">
                                    <label class="col-md-3 col-xs-12 control-label">Peso merma estimado (KG)</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <input readonly type="number" class="form-control" ng-model="lot.decrease_weight" required>
                                            <span class="input-group-addon">
                                                <span class="fa fa-balance-scale"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div ng-if="lot.id">
                                <hr>
                                <h4>Etiquetas</h4>
                                <div class="col-md-12">
                                    <table class="table table-striped row-border hover">
                                        <thead>
                                        <tr>
                                            <th>Calibre</th>
                                            <th>Porcentaje Total</th>
                                            <th>Calidad</th>
                                            <th>Porcentaje Parcial</th>
                                            <th># Etiquetas</th>
                                            <th>Código de Barras</th>
                                            <th>Imprimir</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="caliber in lot.calibers">
                                            <td>
                                                <span class="label label-table label-success">
                                                    @{{ caliber.name }}
                                                </span>
                                            </td>
                                            <td>
                                                @{{ caliber.percentage }} %
                                            </td>
                                            <td class="text-center">
                                                @{{ caliber.pivot.quality | uppercase }}
                                            </td>
                                            <td ng-if="caliber.pivot.quality == 'a'">
                                                @{{ caliber.a_percentage }} %
                                            </td>
                                            <td ng-if="caliber.pivot.quality == 'b'">
                                                @{{ caliber.b_percentage }} %
                                            </td>
                                            <td class="text-center">
                                                @{{ caliber.pivot.box_number }}
                                            </td>
                                            <td>
                                                @{{ caliber.pivot.barcode }}
                                            </td>
                                            <td>
                                                <a href="/labels/lots/@{{lot.id}}/print/@{{caliber.pivot.id}}/calibers" target="_blank" class="btn btn-md btn-primary add-tooltip">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <button ng-if="!lot.id" class="btn btn-success">
                        Guardar <span class="fa fa-lock"></span>
                    </button>

                    <!--<a ng-if="lot.id" href="/labels/lots/@{{lot.id}}/print" target="_blank" class="btn btn-primary">-->
                    <!--<a ng-if="lot.id" href="#" target="_blank" class="btn btn-primary">-->
                    <!--    Imprimir Etiquetas <span class="fa fa-print"></span>-->
                    <!--</a>-->

                </div>
        </form>
    </div>

    <script type="text/ng-template" id="collector_modal.html">
        <div class="modal-header">
            <h3 class="modal-title">Agregar Acopiador</h3>
        </div>
        <div class="modal-body contract-modal">
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Nombre" ng-model="collector.name">
            </div>
            <div class="form-group">
              <input class="form-control" type="number" placeholder="Teléfono" ng-model="collector.phone">
            </div>
        </div>
        <div class="modal-footer">
            <p>
              <button class="btn btn-primary" type="button" ng-click="ok()">Agregar</button>
              <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
            </p>
        </div>
    </script>


    <script type="text/ng-template" id="producer_modal.html">
        <div class="modal-header">
            <h3 class="modal-title">Agregar Productor</h3>
        </div>
        <div class="modal-body contract-modal">
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Nombre" ng-model="producer.name">
            </div>
            <div class="form-group">
              <input class="form-control" type="number" placeholder="Teléfono" ng-model="producer.phone">
            </div>
        </div>
        <div class="modal-footer">
            <p>
              <button class="btn btn-primary" type="button" ng-click="ok()">Agregar</button>
              <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
            </p>
        </div>
    </script>


    <script type="text/ng-template" id="orchard_modal.html">
        <div class="modal-header">
            <h3 class="modal-title">Agregar Huerta</h3>
        </div>
        <div class="modal-body contract-modal">
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Nombre" ng-model="orchard.name">
            </div>
            <div class="form-group">
              <input class="" type="radio" name="orchard_type" ng-model="orchard.type" value="organic"> Organica
              <input class="" type="radio" name="orchard_type" ng-model="orchard.type" value="traditional"> Tradicional
            </div>
        </div>
        <div class="modal-footer">
            <p>
              <button class="btn btn-primary" type="button" ng-click="ok()">Agregar</button>
              <button class="btn btn-warning" type="button" ng-click="cancel()">Cancelar</button>
            </p>
        </div>
    </script>

@endsection
