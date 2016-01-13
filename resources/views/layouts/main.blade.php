<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lumino - {{ $header }}</title>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel='stylesheet' type='text/css' href="{{ asset('assets/css/bootstrap-table.css') }}">
<link rel='stylesheet' type='text/css' href="{{ asset('assets/css/styles.css') }}">
@yield('header')

<!--Icons-->
<script src="{{ asset('assets/js/lumino.glyphs.js') }}"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Bienvenido</span> {{ Auth::user()->nombre }} {{ Auth::user()->apellido }} </a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> {{ Auth::user()->nick }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="{{ route('logout') }}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>

		</div><!-- /.container-fluid -->
	</nav>

	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">

			</div>
		</form>
		<ul class="nav menu">
			<li class="{{ Request::is('home') || Request::is('home/*') ? 'active' : '' }}"><a href="{{ route('inicio') }}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg>Inicio</a></li>
			<li class="parent ">
				<a data-toggle="collapse" href="#sub-item-1">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>Inventario
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li class="{{ Request::is('grupos') || Request::is('grupos/*') ? 'active' : '' }}">
						<a class="" href="{{ route('grupos') }}">
							<svg class="glyph stroked open folder"><use xlink:href="#stroked-open-folder"/></svg> Grupos
						</a>
					</li>
					<li class="{{ Request::is('productos') || Request::is('productos/*') ? 'active' : '' }}">
						<a class="" href="{{ route('productos') }}">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Productos
						</a>
					</li>
					<li>
						<a class="{{ Request::is('proveedores') || Request::is('proveedores/*') ? 'active' : '' }}" href="{{ route('proveedores') }}">
							<svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Proveedores
						</a>
					</li>
					<li>
						<a class="{{ Request::is('entradas') || Request::is('entradas/*') ? 'active' : '' }}" href="{{ route('entradas') }}">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Entradas
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-left"><use xlink:href="#stroked-chevron-left"></use></svg> Salidas
						</a>
					</li>
				</ul>
			</li>
			<li><a href="widgets.html"><svg class="glyph stroked eye"><use xlink:href="#stroked-eye"/></svg> Kardex</a></li>
			<li class="{{ Request::is('clientes') || Request::is('clientes/*') ? 'active' : '' }}"><a href="{{ route('clientes') }}"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Clientes</a></li>
			<li class="{{ Request::is('facturas') || Request::is('facturas/*') ? 'active' : '' }}"><a href="{{ route('facturas') }}"><svg class="glyph stroked app window with content"><use xlink:href="#stroked-app-window-with-content"/></svg> Facturas</a></li>
			<li><a href="forms.html"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Gastos</a></li>
			<li><a href="panels.html"><svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"/></svg> Permitidos</a></li>
			<li><a href="icons.html"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Devoluciones</a></li>
			<li class="parent ">
				<a href="#sub-item-2" data-toggle="collapse">
					<span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg></span>Informes
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="{{ Request::is('informes/entradas') || Request::is('informes/entradas/*') ? 'active' : '' }}" href="{{ route('informes_entradas') }}">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Entradas
						</a>
					</li>
					<li class="{{ Request::is('grupos') || Request::is('grupos/*') ? 'active' : '' }}">
						<a class="" href="{{ route('grupos') }}">
							<svg class="glyph stroked app window with content"><use xlink:href="#stroked-app-window-with-content"/></svg> Facturas
						</a>
					</li>
					<li class="{{ Request::is('productos') || Request::is('productos/*') ? 'active' : '' }}">
						<a class="" href="{{ route('productos') }}">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Productos
						</a>
					</li>
					<li>
						<a class="{{ Request::is('proveedores') || Request::is('proveedores/*') ? 'active' : '' }}" href="{{ route('proveedores') }}">
							<svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Clientes
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-left"><use xlink:href="#stroked-chevron-left"></use></svg> Consumos
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-left"><use xlink:href="#stroked-chevron-left"></use></svg> Devoluciones
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-left"><use xlink:href="#stroked-chevron-left"></use></svg> Reporte Financiero
						</a>
					</li>
				</ul>
			</li>
			<li role="presentation" class="divider"></li>
			<li><a href="#"><img src="{{ asset('assets/images/logo.png') }}" width="89" height="64"  alt=""/></a></li>
		</ul>

	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"> {{ $breadcrumb }}</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">{{ $header }}</h1>
			</div>
		</div><!--/.row-->

    @yield('content')

	</div>	<!--/.main-->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script>

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){
		        $(this).find('em:first').toggleClass("glyphicon-minus");
		    });
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		});
	</script>

  @yield('scripts')

</body>

</html>
