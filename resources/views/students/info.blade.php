@extends('layouts.app')

@section('title_tab', 'Información' )

@section('title', 'Información Personal')

@section('controller_js')

<script type="text/javascript" src="{{asset('js/controllers/studentInfo.js')}}"></script>

@endsection

@section('extra_css')
    
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div class="eq-height" ng-controller="studentInfoCtrl">
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-md-offset-3 col-lg-offset-2">
        <!--Profile Widget-->
        <!--===================================================-->
        <div class="panel text-center">
            <div class="panel-body">
                <img alt="Avatar" 
                class="img-md img-circle img-border mar-btm" 
                src="{{asset('img/logo_buap.png')}}">
                <h2 class="mar-no">@{{user.name}} @{{user.lastname}}</h4>
                <br>
                <p>Matrícula: <strong>@{{user.key}}</strong></p>
                <p class="text-muted">
                    Correo Electrónico: <strong>@{{user.email}}</strong>
                </p>
            </div>
            <div class="pad-all">
                <div class="pad-btm">
                    <a href="http://www.buap.mx/" target="_blank" class="btn btn-primary">BUAP</a>
                    <a href="http://www.cs.buap.mx/" target="_blank" class="btn btn-success">FCC</a>
                </div>
            </div>
        </div>
        <!--===================================================-->
    </div>
</div>
@endsection
