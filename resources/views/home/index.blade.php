@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-blue panel-widget ">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large">120</div>
					<div class="text-muted">Ventas Hoy</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-orange panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large">52</div>
					<div class="text-muted">Compras Hoy</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-teal panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large">24</div>
					<div class="text-muted">Permitidos</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-red panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large">25.2k</div>
					<div class="text-muted">Clientes</div>
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">Informacion </div>
        <div class="panel-body">
          <div class="col-md-12">
            <div class="chat-body clearfix">

              <div class="header">
                <strong class="primary-font">Administrador</strong> <small class="text-muted">23/09/2015</small>
              </div>
              <p>Mensaje del administrador. </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading"><small>&copy; Desarrollo de BoxMedia S.A.S </small></div>
        <div class="panel-body">
          <div class="col-md-12">
            <div class="chat-body clearfix">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
