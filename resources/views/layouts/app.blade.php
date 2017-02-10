<!DOCTYPE html>
<html ng-app="aguacates">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LabelCash |  @yield('title_tab')</title>


	<!--STYLESHEET-->
	<!--=================================================-->
 	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/nifty.min.css') }}" rel="stylesheet">
	<!--<link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">-->
	<script src="https://use.fontawesome.com/d9f123dd08.js"></script>
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
	<!-- END Angular -->
	<script type="text/javascript" src={{ asset("js/app.js") }}></script>
	<script type="text/javascript" src={{ asset("js/filters/dateFormat.js") }}></script>
	<script type="text/javascript" src={{ asset("js/directives/enter.js") }}></script>
	<script type="text/javascript" src={{ asset("js/services/alert.js") }}></script>
	<script type="text/javascript" src={{ asset("js/services/user.js") }}></script>
	<script type="text/javascript" src={{ asset("js/services/confirm.js") }}></script>
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
							<span class="brand-text">LabelCash</span>
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

									<!--Category name-->
									<li class="list-header">Menú</li>

                                    @if(Auth::user()->role->name == "admin")

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
									<li class="{{ Request::is('labels/*') ? 'active-sub active' : '' }}">
										<a href="#">
											<i class="fa fa-th"></i>
											<span class="menu-title">
												<strong>Etiquetas</strong>
											</span>
											<i class="arrow"></i>
										</a>

										<!--Submenu-->
										<ul class="collapse">
											<li class="{{ Request::is('labels/lots') ? 'active-link' : '' }}">
												<a href="/labels/lots">Lotes</a>
											</li>
											<li class="{{ Request::is('labels/stages') ? 'active-link' : '' }}">
												<a href="/labels/stages">Tarimas</a>
											</li>
										</ul>
									</li>


									<li class="{{ Request::is('shipments/*') ? 'active-sub active' : '' }}">
										<a href="#">
											<i class="fa fa-truck"></i>
											<span class="menu-title">
												<strong>Embarques</strong>
											</span>
											<i class="arrow"></i>
										</a>

										<!--Submenu-->
										<ul class="collapse">
											<li class="{{ Request::is('shipments/create') ? 'active-link' : '' }}">
												<a href="/shipments/create">Nuevo</a>
											</li>
											<li class="{{ Request::is('shipments/list') ? 'active-link' : '' }}">
												<a href="/shipments/list">Entrega y Recepción</a>
											</li>
										</ul>
									</li>


									<li class="{{ Request::is('stock/*') ? 'active-sub active' : '' }}">
										<a href="#">
											<i class="fa fa-database"></i>
											<span class="menu-title">
												<strong>Almacén</strong>
											</span>
											<i class="arrow"></i>
										</a>

										<!--Submenu-->
										<ul class="collapse">
											<li class="{{ Request::is('stock/create') ? 'active-link' : '' }}">
												<a href="/stock/create">Nueva Salida</a>
											</li>
											<li class="{{ Request::is('stock/list') ? 'active-link' : '' }}">
												<a href="/stock/list">Lista de Salidas</a>
											</li>
										</ul>
									</li>


									<li class="{{ Request::is('configuration/*') ? 'active-sub active' : '' }}">
										<a href="#">
											<i class="fa fa-cogs"></i>
											<span class="menu-title">
												<strong>Configuración</strong>
											</span>
											<i class="arrow"></i>
										</a>

										<ul class="collapse">
											<li class="{{ Request::is('configuration/general') ? 'active-link' : '' }}">
												<a href="/configuration/general">General</a>
											</li>
										</ul>

										<!--Submenu-->
										<ul class="collapse">
											<li class="{{ Request::is('configuration/calibers') ? 'active-link' : '' }}">
												<a href="/configuration/calibers">Calibres</a>
											</li>
										</ul>

										<ul class="collapse">
											<li class="{{ Request::is('configuration/stages') ? 'active-link' : '' }}">
												<a href="/configuration/stages">Tarimas - Cajas</a>
											</li>
										</ul>
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

			<p class="pad-lft">&#0169; 2016 VICAMSoftware</p>

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
</body>
</html>
