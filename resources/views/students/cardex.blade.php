@extends('layouts.app')

@section('title_tab', 'Cardex' )

@section('title', 'Cardex' )

@section('controller_js')

@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
<li><a href="/subjects">Cardex</a></li>
@endsection

@section('content')
<div class="eq-height">
    <div class="col-sm-4 eq-box-sm">
        <div class="panel">
            <div class="panel-body">
                <div>
                    <a class="btn btn-primary" href="/subjects/create">
                        <span class="fa fa-plus"></span>
                        Nueva Materia
                    </a>
                </div>
                <br>
                <div>
                    {{$student}}
                    <uib-alert ng-repeat="alert in alerts"
                               dismiss-on-timeout="5000"
                               type="@{{alert.type}}"
                               close="alertService.closeAlert($index)">
                               @{{alert.msg}}
                    </uib-alert>

                    <table datatable="ng" class="table table-striped row-border hover">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>NRC</th>
                            <th>Periodo</th>
                            <th>Clave</th>
                            <th>Sección</th>
                            <th>Salón y horario</th>
                            <th>Información</th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr >
                            
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
