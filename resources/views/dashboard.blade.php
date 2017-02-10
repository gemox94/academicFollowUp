@extends('layouts.app')

@section('title_tab', 'Inicio' )

@section('title', '<span class="fa fa-home"></span> Inicio' )

@section('controller_js')
<script type="text/javascript" src={{ asset("js/controllers/dashboard.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
<li><a href="/dashboard">Dashboard</a></li>
@endsection

@section('content')
<div ng-controller="DashboardCtrl">

</div>
@endsection
