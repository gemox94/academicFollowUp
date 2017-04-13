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

</div>
@endsection
