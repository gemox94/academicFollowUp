@extends('layouts.app')

@section('title_tab', 'Materias' )

@section('title', 'Materias' )

@section('controller_js')

@endsection

@section('extra_css')
    
@endsection

@section('breadcrumb')
<li><a href="/student/subjects">Materias</a></li>
@endsection

@section('content')
<div class="eq-height">
    <div class="col-sm-4 eq-box-sm">
        <div class="panel">
            <div class="panel-body">
                <div>
                    <uib-alert ng-repeat="alert in alerts"
                               dismiss-on-timeout="5000"
                               type="@{{alert.type}}"
                               close="alertService.closeAlert($index)">
                               @{{alert.msg}}
                    </uib-alert>

                    <table  class="table table-hover">
                        <thead>
                        <tr>
                            <th>Materia</th>
                            <th>NRC</th>
                            <th>Salon/Horario</th>
                            <th>Sección</th>
                            <th>Periodo</th>
                            <th>Calificación Final</th>

                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($student->teacher_subjects as $subject)
                                <tr>
                                    <td>{{$subject->name}}</td>
                                    <td>{{$subject->nrc}}</td>
                                    <td>{{$subject->schedule_json}}</td>
                                    <td>{{$subject->section}}</td>
                                    <td>{{$subject->period}}</td>
                                    <td>{{$subject->pivot->final_grade}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
