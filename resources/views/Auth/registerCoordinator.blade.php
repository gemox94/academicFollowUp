@extends('layouts.app')

@section('title_tab', 'Registrar coordinador' )

@section('title', 'Registrar coordinador' )

@section('controller_js')
<script type="text/javascript" src={{ asset("js/controllers/registerCoordinator.js") }}></script>
@endsection

@section('extra_css')
@endsection

@section('breadcrumb')
<li><a href="/coordinator_register">Registrar Coordinador</a></li>
@endsection

@section('content')
<script>
    $(document).ready(function(){
        var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
          if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
            $(password).css("border", "1px solid red");
            $(confirm_password).css("border", "1px solid red");

          } else {
            confirm_password.setCustomValidity('');
            $(password).css("border", "1px solid green");
            $(confirm_password).css("border", "1px solid green");
          }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
        });
</script>

<div ng-controller="RegisterCoordinatorCtrl">
    <div class="panel panel-default tabs">
        <uib-alert ng-repeat="alert in alerts"
               dismiss-on-timeout="5000"
               type="@{{alert.type}}"
               close="alertService.closeAlert($index)">
               @{{alert.msg}}
        </uib-alert>

        <form class="form-horizontal" name="lot_form" ng-submit="createCoordinator()" id="coordinator_form">
            <div class="panel-body tab-content" id="print-section" >
                <div class="tab-pane active" id="datos">
                    <div>
                        <h4>
                          Registrarse como coordinador
                        </h4>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Nueva Contraseña</label>
                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <input type="password" class="form-control" ng-model="coordinator.password" id="password" required>
                                    <span class="input-group-addon">
                                        <span class="fa fa-lock"></span>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Confirmar</label>
                            <div class="col-md-4 col-xs-12">
                                <div class="input-group">
                                    <input type="password" class="form-control" ng-model="coordinator.password2" id="confirm_password" required>
                                    <span class="input-group-addon">
                                        <span class="fa fa-lock"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <button class="btn btn-mint">
                    Guardar <span class="fa fa-lock"></span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
