<!DOCTYPE html>
<html ng-app="academic">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Seguimiento |  @yield('title_tab')</title>


	<!--STYLESHEET-->
	<!--=================================================-->
 	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/nifty.min.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<!--<script src="https://use.fontawesome.com/d9f123dd08.js"></script>-->
	<link href="{{ asset('plugins/animate-css/animate.min.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/morris-js/morris.min.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/switchery/switchery.min.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/demo/nifty-demo.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('extra_css')

	<!--SCRIPT-->
	<!--=================================================-->

	<!--Page Load Progress Bar [ OPTIONAL ]-->
	<!--<link href="plugins/pace/pace.min.css" rel="stylesheet">
	<script src="plugins/pace/pace.min.js"></script>-->

	<!-- JavaScripts -->
	<script type="text/javascript" src={{ asset('bower/jquery/dist/jquery.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular/angular.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-resource/angular-resource.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-route/angular-router.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angularUtils-pagination/dirPagination.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/datatables.net/js/jquery.dataTables.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-datatables/dist/angular-datatables.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-ui-bootstrap/angular-ui-bootstrap.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/ngstorage/ngStorage.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-spinners/dist/angular-spinners.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-sanitize/angular-sanitize.min.js') }}></script>
	<script type="text/javascript" src={{ asset('bower/angular-bootstrap-confirm/dist/angular-bootstrap-confirm.js') }}></script>

	<script type="text/javascript" src={{ asset("js/app.js") }}></script>
	<script type="text/javascript" src={{ asset("js/filters/dateFormat.js") }}></script>
	<script type="text/javascript" src={{ asset("js/directives/enter.js") }}></script>
	<script type="text/javascript" src={{ asset("js/services/alert.js") }}></script>
	<script type="text/javascript" src={{ asset("js/services/user.js") }}></script>
	<script type="text/javascript" src={{ asset("js/services/confirm.js") }}></script>
    <script>
        (function () {
            angular.module('academic').constant('CSRF_TOKEN', '{{csrf_token()}}');
        })();
    </script>

	@yield('controller_js')

</head>

<body ng-cloak>
	<div id="container" class="effect mainnav-lg">

		<!--NAVBAR-->
		<!--===================================================-->
		<header id="navbar">
			<div id="navbar-container" class="boxed">

				<!--Brand logo & name-->
				<!--================================-->
				<div class="navbar-header">
					<a href="index.html" class="navbar-brand">
						<!--<img src="img/logo.png" alt="Nifty Logo" class="brand-icon">-->
						<div class="brand-title">
							<span class="brand-text">Seguimiento Académico</span>
						</div>
					</a>
				</div>
				<!--================================-->
				<!--End brand logo & name-->


				<!--Navbar Dropdown-->
				<!--================================-->
				<div class="navbar-content clearfix">
					<ul class="nav navbar-top-links pull-left">

						<!--Navigation toogle button-->
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<li class="tgl-menu-btn">
							<a class="mainnav-toggle" href="#">
								<i class="fa fa-navicon fa-lg"></i>
							</a>
						</li>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<!--End Navigation toogle button-->


						<!--Messages Dropdown-->
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<!--End message dropdown-->




						<!--Notification dropdown-->
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<!--End notifications dropdown-->



						<!--Mega dropdown-->
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<!--End mega dropdown-->

					</ul>
					<ul class="nav navbar-top-links pull-right">
						<!--User dropdown-->
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<li id="dropdown-user" class="dropdown">
							<a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
								<!--<span class="pull-right">
									<img class="img-circle img-user media-object" src="img/av1.png" alt="Profile Picture">
								</span>-->
								<div class="username hidden-xs">
										{{ Auth::user()->name }}
								</div>
							</a>


							<div class="dropdown-menu dropdown-menu-md dropdown-menu-right with-arrow panel-default">


								<!-- User dropdown menu -->
								<ul class="head-list">
									<li>
										<a href="#">
											<i class="fa fa-user fa-fw fa-lg"></i> Perfil
										</a>
									</li>
								</ul>

								<!-- Dropdown footer -->
								<div class="pad-all text-right">
									<a href="/logout" class="btn btn-primary">
										<i class="fa fa-sign-out fa-fw"></i> Salir
									</a>
								</div>
							</div>
						</li>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<!--End user dropdown-->

					</ul>
				</div>
				<!--================================-->
				<!--End Navbar Dropdown-->

			</div>
		</header>
		<!--===================================================-->
		<!--END NAVBAR-->

		<div class="boxed">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">

				<!--Page Title-->
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<div id="page-title">
					<h1 class="page-header text-overflow">
						@yield('title')
					</h1>
				</div>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<!--End page title-->

				<!--Breadcrumb-->
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<ol class="breadcrumb">
					@yield('breadcrumb')
				</ol>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<!--End breadcrumb-->

				<!--Page content-->
				<!--===================================================-->
				<div id="page-content">
					<div class="row">
                        @yield('content')
					</div>
				</div>
				<!--===================================================-->
				<!--End page content-->
			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->


			<!--MAIN NAVIGATION-->
			<!--===================================================-->
			<nav id="mainnav-container">
				<div id="mainnav">

					<!--Shortcut buttons-->
					<!--================================-->

					<!--================================-->
					<!--End shortcut buttons-->


					<!--Menu-->
					<!--================================-->
					<div id="mainnav-menu-wrap">
						<div class="nano">
							<div class="nano-content">
								<ul id="mainnav-menu" class="list-group">

                                    @if(Auth::user()->role->name == "coordinator")

									<li class="list-header">Menú - Coordinador</li>

									<!--Menu list item-->
									<li class="{{ Request::is('dashboard') ? 'active-link' : '' }}">
										<a href="/dashboard">
											<i class="fa fa-dashboard"></i>
											<span class="menu-title">
												<strong>Inicio</strong>
											</span>
										</a>
									</li>

                                    @endif

									@if(Auth::user()->role->name == "teacher")

										<li class="list-header">Menú - Profesor</li>

										<!--Menu list item-->
										<li class="{{ Request::is('dashboard') ? 'active-link' : '' }}">
											<a href="/dashboard">
												<i class="fa fa-dashboard"></i>
												<span class="menu-title">
													<strong>Inicio</strong>
												</span>
											</a>
										</li>

										<!--Menu list item-->
										<li class="{{ Request::is('subjects') ? 'active-link' : '' }}">
											<a href="/subjects">
												<i class="fa fa-th"></i>
												<span class="menu-title">
													<strong>Materias</strong>
												</span>
											</a>
										</li>

											<li class="{{ Request::is('students') ? 'active-link' : '' }}">
												<a href="/teacher_students">
													<i class="fa fa-users"></i>
													<span class="menu-title">
													<strong>Estudiantes</strong>
												</span>
												</a>
											</li>

										<li class="{{Request::is('statistics') ? 'active-link' : ''}}">

                                            <a href="/statistics">
                                                <i class="fa fa-bar-chart-o"></i>
                                                <span class="menu-title"></span>
                                                <strong>Estadísticas</strong>
                                            </a>

                                        </li>


										@if(!$coordinator)
											<li class="{{ Request::is('coordinator_register') ? 'active-link' : '' }}">
												<a href="/coordinator_register">
													<i class="fa fa-user"></i>
													<span class="menu-title">
														<strong> Darse de alta coordinador</strong>
													</span>
												</a>
											</li>
										@endif

                                    @endif

									@if(Auth::user()->role->name == "student")

										<li class="list-header">Menú - Estudiante</li>

										<!--Menu list item-->
										<li class="{{ Request::is('dashboard') ? 'active-link' : '' }}">
											<a href="/dashboard">
												<i class="fa fa-dashboard"></i>
												<span class="menu-title">
													<strong>Inicio</strong>
												</span>
											</a>
										</li>


										<!--Menu list item-->
										<li class="{{ Request::is('student/advertisements') ? 'active-link' : '' }}">
											<a href="/student/advertisements/">
												<i class="fa fa-newspaper-o"></i>
												<span class="menu-title">
													<strong>Anuncios</strong>
												</span>
											</a>
										</li>


										<!--Menu list item-->
										<li class="{{ Request::is('students/*/cardex') ? 'active-link' : '' }}">
											<a href="/students/{{ Auth::user()->id }}/cardex">
												<i class="fa fa-newspaper-o"></i>
												<span class="menu-title">
													<strong>Historial Académico</strong>
												</span>
											</a>
										</li>

                                    @endif

									<!--Menu list item-->
									<li>
										<a href="/logout">
											<i class="fa fa-sign-out"></i>
											<span class="menu-title">
												<strong>Salir</strong>
											</span>
										</a>
									</li>

									<li class="list-divider"></li>

									<!--Category name-->
									<!--<li class="list-header">Components</li>-->

									<!--Menu list item-->

								</ul>

							</div>
						</div>
					</div>
					<!--================================-->
					<!--End menu-->

				</div>
			</nav>
			<!--===================================================-->
			<!--END MAIN NAVIGATION-->

			<!--ASIDE-->
			<!--===================================================-->

			<!--===================================================-->
			<!--END ASIDE-->

		</div>



		<!-- FOOTER -->
		<!--===================================================-->
		<footer id="footer">


			<!-- Visible when footer positions are static -->
			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->


			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
			<!-- Remove the class name "show-fixed" and "hide-fixed" to make the content always appears. -->
			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
			<p class="pad-lft">&#0169; Benemérita Universidad Autónoma de Puebla - FCC</p>

		</footer>
		<!--===================================================-->
		<!-- END FOOTER -->


		<!-- SCROLL TOP BUTTON -->
		<!--===================================================-->

		<!--===================================================-->



	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->




	<!-- SETTINGS - DEMO PURPOSE ONLY -->
	<!--===================================================-->

	<!--===================================================-->
	<!-- END SETTINGS -->


	<!--JAVASCRIPT-->
	<!--=================================================-->
	<script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('plugins/fast-click/fastclick.min.js') }}"></script>
	<script src="{{ asset('js/nifty.min.js') }}"></script>
	<script src="{{ asset('plugins/morris-js/morris.min.js') }}"></script>
	<script src="{{ asset('plugins/morris-js/raphael-js/raphael.min.js') }}"></script>
	<script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
	<script src="{{ asset('plugins/skycons/skycons.min.js') }}"></script>
	<script src="{{ asset('plugins/switchery/switchery.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>

    <script src="{{asset('js/plotly-latest.min.js')}}"></script>


</body>
</html>
