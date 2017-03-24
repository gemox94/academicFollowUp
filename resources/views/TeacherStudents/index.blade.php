@extends('dashboard')

@section('title_tab', 'Alumnos' )

@section('title', 'Mis alumnos' )

@section('controller_js')
    <script type="text/javascript" src={{ asset("js/controllers/teacherStudentIndex.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
    <li><a href="/teacher-students">Alumnos</a></li>
@endsection

@section('content')
<div ng-controller="teacherStudentIndexCtrl">



</div>

@endsection