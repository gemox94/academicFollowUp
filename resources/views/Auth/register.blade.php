<!doctype html>
<html lang="en">
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

    <title>Registro</title>
</head>
<body>

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
                    <form action="/register" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <label for="rol_2" class="no-style">
                                    <div class="panel panel-info panel-colorful">
                                        <div class="pad-all text-center">
                                            <span class="text-3x text-thin">Profesor</span>
                                            <p><input type="radio" name="rol" value="2" id="rol_2"></p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-sm-4 col-sm-offset-1">
                                <label for="rol_3" class="no-style">
                                    <div class="panel panel-success panel-colorful">
                                        <div class="pad-all text-center">
                                            <span class="text-3x text-thin">Alumno</span>
                                            <p><input type="radio" name="rol" value="3" id="rol_3"></p>
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
                                        <input type="text" class="form-control" placeholder="Nombre (s)" name="name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Apellidos" name="lastname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                        <input type="password" class="form-control" placeholder="Contraseña" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirmar Contraseña" name="confirmpass">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                        <input type="text" class="form-control" placeholder="Correo Elctrónico" name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" placeholder="Matrícula" name="key">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" placeholder="Teléfono" name="phone">
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