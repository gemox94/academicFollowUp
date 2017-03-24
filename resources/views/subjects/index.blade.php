@extends('layouts.app')

@section('title_tab', 'Materias' )

@section('title', 'Materias' )

@section('controller_js')
<script type="text/javascript" src={{ asset("js/controllers/subjects.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
<li><a href="/Materias">Materias</a></li>
@endsection

@section('content')
<div ng-controller="MateriasCtrl">

</div>
@endsection
