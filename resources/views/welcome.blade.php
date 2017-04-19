<!DOCTYPE html>
<html lang="en" ng-app="academic">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bienivenido</title>


	<!--STYLESHEET-->
	<!--=================================================-->

	<!--Open Sans Font [ OPTIONAL ] -->
 	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">

	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/nifty.min.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/demo/nifty-demo.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

	<!--SCRIPT-->
	<!--=================================================-->

	<!--Page Load Progress Bar [ OPTIONAL ]-->
	<link href="{{ asset('plugins/pace/pace.min.css') }}" rel="stylesheet">
	<script src="{{ asset('plugins/pace/pace.min.js') }}"></script>

        <!--SCRIPTS NECESARIOS PARA EL PROYECTO-->
	<script type="text/javascript" src={{ asset('bower/jquery/dist/jquery.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular/angular.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-resource/angular-resource.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-route/angular-router.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angularUtils-pagination/dirPagination.js') }}></script>
	<script type="text/javascript" src="https://code.angularjs.org/1.5.0/i18n/angular-locale_es-mx.js"></script>
	<script type="text/javascript" src={{ asset('bower/select2/dist/js/select2.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/datatables.net/js/jquery.dataTables.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-datatables/dist/angular-datatables.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/jquery-datatables-columnfilter/jquery.dataTables.columnFilter.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-datatables/dist/plugins/columnfilter/angular-datatables.columnfilter.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-ui-bootstrap/angular-ui-bootstrap.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/ngstorage/ngStorage.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-spinners/dist/angular-spinners.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-sanitize/angular-sanitize.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-bootstrap-confirm/dist/angular-bootstrap-confirm.js') }}></script>
        <script type="text/javascript" src={{ asset('js/app.js') }}></script>
	<script type="text/javascript" src={{ asset('js/services/user.js') }}></script>
	<script type="text/javascript" src={{ asset('js/services/alert.js') }}></script>
        <script type="text/javascript" src={{ asset('js/controllers/login.js') }}></script>
        <script>
                angular.module("academic").constant("CSRF_TOKEN", '{{ csrf_token() }}');
        </script>

</head>

<body ng-controller='LoginController'>
	<div id="container" class="cls-container">

		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay" class="bg-img img-balloon"></div>


		<!-- HEADER -->
		<!--===================================================-->
		<div class="cls-header cls-header-lg">
			<div class="cls-brand">
				<a class="box-inline" href="index.html">
					<!-- <img alt="Nifty Admin" src="img/logo.png" class="brand-icon"> -->
					<span class="brand-title">SISTEMA DE SEGUIMIENTO ACADÉMICO <br><span class="text-thin">DEL ÁREA DE PROGRAMACIÓN</span></span>
				</a>
			</div>
		</div>
		<!--===================================================-->


		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
			<div class="cls-content-sm panel">
				<div class="panel-body">
					<h4 class="pad-btm">Iniciar Sesión</h4>
                                        {{ get_alert() }}
					<form name="LoginForm">
                                                <div class="alert alert-danger" ng-show="bad_request">
                                                        <p>@{{bad_message}}</p>
                                                </div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-user"></i></div>
								<input ng-model="user.email" type="email" name="email" class="form-control" placeholder="Email" required>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
								<input ng-model="user.password" type="password" name="password" class="form-control" placeholder="Contraseña" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button class="col-md-12 btn btn-mint text-uppercase" type="submit" ng-click="submit()">Entrar</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="margin-top: 5px;">
								<a class="col-md-12 btn btn-info text-uppercase" href="/register/view">Registrarse</a>
							</div>
						</div>
						<!--<div class="mar-btm"><em>- or -</em></div>
						<button class="btn btn-primary btn-lg btn-block" type="button">
							<i class="fa fa-facebook fa-fw"></i> Login with Facebook
						</button>-->
					</form>
				</div>
			</div>
			<!--<div class="pad-ver">
				<a href="pages-password-reminder.html" class="btn-link mar-rgt">Forgot password ?</a>
				<a href="pages-register.html" class="btn-link mar-lft">Create a new account</a>
			</div>-->
		</div>
		<!--===================================================-->


		<!-- DEMO PURPOSE ONLY -->
		<!--===================================================-->
		<!--<div class="demo-bg">
			<div id="demo-bg-list">
				<div class="demo-loading"><i class="fa fa-refresh"></i></div>
				<img class="demo-chg-bg bg-trans" src="img/bg-img/thumbs/bg-trns.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-1.jpg" alt="Background Image">
				<img class="demo-chg-bg active" src="img/bg-img/thumbs/bg-img-2.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-3.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-4.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-5.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-6.jpg" alt="Background Image">
				<img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-7.jpg" alt="Background Image">
			</div>
		</div>-->
		<!--===================================================-->



	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->



	<!--JAVASCRIPT-->
	<!--=================================================-->

	<!--jQuery [ REQUIRED ]-->
	<script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>


	<!--BootstrapJS [ RECOMMENDED ]-->
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>

	<!--Nifty Admin [ RECOMMENDED ]-->
	<script src="{{ asset('js/nifty.min.js') }}"></script>


	<!--Background Image [ DEMONSTRATION ]-->
	<script src="{{ asset('js/demo/bg-images.js') }}"></script>

</body>
</html>
