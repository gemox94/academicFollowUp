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
                <span class="brand-title"></span>
            </div>
        </div>

        <!-- REGISTRATION FORM -->
        <!--===================================================-->
        <div class="cls-content">
            <div class="cls-content-lg panel">
                <div class="panel-body">
                    <h3 class="pad-btm" id="register-title">Registro</h3>
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
                                                      value="2" id="rol_2" required></p>
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
                                               required
                                               ng-model="user.name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Apellidos"
                                           required
                                           ng-model="user.lastname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                        <input type="password" class="form-control" placeholder="Contraseña"
                                               required
                                               ng-model="user.password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirmar Contraseña"
                                           required
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
                                               required
                                               ng-model="user.email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" placeholder="Matrícula"
                                               required
                                               ng-model="user.key">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" placeholder="Teléfono"
                                               required
                                               ng-model="user.phone">
                                    </div>
                                </div>

                                <div class="form-group" ng-show="show_cubicle">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" placeholder="Cubículo"
                                               required
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