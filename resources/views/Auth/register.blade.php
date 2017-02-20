<!doctype html>
<html lang="en" ng-app="academic">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Open Sans Font [ OPTIONAL ] -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{asset('css/nifty.min.css')}}" rel="stylesheet">
    <!--Font Awesome [ OPTIONAL ]-->
    <link href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <!--Custom CSS rules-->
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

    <!--Page Load Progress Bar [ OPTIONAL ]-->
    <link href="{{asset('plugins/pace/pace.min.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/pace/pace.min.js')}}"></script>

    <!--SCRIPTS NECESARIOS PARA EL PROYECTO-->
    <script type="text/javascript" src={{ asset('bower/angular/angular.js') }}></script>
    <script type="text/javascript" src={{ asset('bower/angular-resource/angular-resource.min.js') }}></script>
    <script type="text/javascript" src={{ asset('bower/angular-route/angular-router.js') }}></script>
    <script type="text/javascript" src={{ asset('bower/jquery/dist/jquery.min.js') }}></script>
    <script type="text/javascript" src={{ asset('bower/datatables.net/js/jquery.dataTables.min.js') }}></script>
    <script type="text/javascript" src={{ asset('bower/angular-datatables/dist/angular-datatables.min.js') }}></script>
    <script type="text/javascript" src={{ asset('bower/angularUtils-pagination/dirPagination.js') }}></script>
    <script type="text/javascript" src={{ asset('bower/angular-ui-bootstrap/angular-ui-bootstrap.js') }}></script>
    <script type="text/javascript" src={{ asset('bower/ngstorage/ngStorage.min.js') }}></script>
    <script type="text/javascript" src={{ asset('bower/angular-spinners/dist/angular-spinners.min.js') }}></script>
    <script type="text/javascript" src={{ asset('js/app.js') }}></script>
    <script type="text/javascript" src={{ asset('js/services/user.js') }}></script>
    <script type="text/javascript" src={{ asset('js/services/alert.js') }}></script>
    <script type="text/javascript" src={{ asset('js/controllers/login.js') }}></script>
    <script type="text/javascript" src={{ asset('js/controllers/register.js') }}></script>
    <script>
        angular.module("academic").constant("CSRF_TOKEN", '{{ csrf_token() }}');
    </script>

    <title>Registro</title>
</head>
<body ng-controller="registerController">

    <div id="container" class="cls-container">

        <!-- BACKGROUND IMAGE -->
        <!--===================================================-->
        <div id="bg-overlay" class="bg-img img-fcc"></div>

        <!-- HEADER -->
        <!--===================================================-->
        <div class="cls-header cls-header-lg">
            <div class="cls-brand">
                <span class="brand-title">Registro</span>
            </div>
        </div>

        <!-- REGISTRATION FORM -->
        <!--===================================================-->
        <div class="cls-content">
            <div class="cls-content-lg panel">

                <div class="panel panel-purple panel-colorful">
                    <div class="pad-all text-center">
                        <p>La contraseña para profesores debe empezar con P.</p>
                        <p>La contraseña para alumnos debe empezar con A.</p>
                        <p>Seguidos de 6 caracteres alfanuméricos!</p>
                    </div>
                </div>

                <uib-alert ng-repeat="alert in alerts"
                    dismiss-on-timeout="5000"
                    type="@{{ alert.type }}"
                    close="alertService.closeAlert($index)">
                    @{{ alert.msg }}
                </uib-alert>

                <div class="panel-body">

                    <form ng-submit="submit()">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <label for="rol_2" class="no-style">
                                    <div class="panel panel-info panel-colorful">
                                        <div class="pad-all text-center">
                                            <span class="text-3x text-thin">Profesor</span>
                                            <p><input type="radio"
                                                      ng-model="user.rol"
                                                      ng-change="check_radio()"
                                                      value="2" id="rol_2" ></p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-sm-4 col-sm-offset-1">
                                <label for="rol_3" class="no-style">
                                    <div class="panel panel-success panel-colorful">
                                        <div class="pad-all text-center">
                                            <span class="text-3x text-thin">Alumno</span>
                                            <p><input type="radio"
                                                      ng-model="user.rol"
                                                      ng-change="check_radio()"
                                                      value="3" id="rol_3"></p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                        <input type="text" class="form-control" placeholder="Nombre (s)"

                                               ng-model="user.name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Apellidos"

                                           ng-model="user.lastname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" ng-class="{'has-error has-feedback':bad_password}">
                                    <label for="demo-oi-errinput" class="control-label" ng-show="bad_password">La Contraseña de Profesor debe empezar con P</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                        <input type="password" class="form-control" placeholder="Contraseña"
                                               ng-change="checkPass()"
                                               ng-model="user.password">
                                    </div>
                                    <span class="fa fa-times fa-lg form-control-feedback" ng-show="bad_password"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirmar Contraseña"
                                           ng-model="user.confirmpass">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                        <input type="text" class="form-control" placeholder="Correo Elctrónico"

                                               ng-model="user.email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" placeholder="Matrícula"

                                               ng-model="user.key">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="text" class="form-control" placeholder="Teléfono"

                                               ng-model="user.phone">
                                    </div>
                                </div>

                                <div class="form-group" ng-show="show_cubicle">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-"></i></div>
                                        <input type="text" class="form-control" placeholder="Cubículo"

                                               ng-model="user.cubicle">
                                    </div>
                                </div>

                            </div>
                        </div>

                        @if(count($errors) > 0)
                            <div class="row">
                                @foreach ($errors->all() as $error)
                                    <div class="col-sm-4 col-sm-offset-4 alert alert-danger">
                                        <p>{{ $error }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn btn-info btn-lg btn-block" type="submit">
                                    Registrarse
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="pad-ver">
                ¿Ya tiene una cuenta? <a href="/" class="btn-link mar-rgt">Iniciar Sesión</a>
            </div>
        </div>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
    <!--jQuery [ REQUIRED ]-->
    <script src="{{asset('js/jquery-2.1.1.min.js')}}"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>


    <!--Fast Click [ OPTIONAL ]-->
    <script src="{{asset('plugins/fast-click/fastclick.min.js')}}"></script>


    <!--Nifty Admin [ RECOMMENDED ]-->
    <script src="{{asset('js/nifty.min.js')}}"></script>
</body>
</html>