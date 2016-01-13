@extends('layouts.main')

@section('content')
<div class="row">
  @include('common.success')
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><a href="{{ route('facturas_nuevo') }}" class="btn btn-primary btn-md">Crear Nueva Factura</a></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Tabla De Facturas</div>
			<div class="panel-body">
        <script type="text/javascript">
          function operateFormatter(value, row, index) {
            return [
                '<a class="edit ml10" href="javascript:void(0)" title="Generar PDF">',
                    '<i class="glyphicon glyphicon-list-alt"></i>',
                '</a>'
            ].join('');
          }

          window.operateEvents = {
              'click .edit': function (e, value, row, index) {
                window.location.assign("/facturas/pdf/" + row.codigo);
              }
          };
        </script>
				<table data-toggle="table" data-url="{{ route('facturas_api') }}"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="updated_at" data-sort-order="desc">
				    <thead>
				    <tr>
				        <th data-field="codigo" data-sortable="true">Factura</th>
				        <th data-field="updated_at"  data-sortable="true">Fecha</th>
                <th data-field="descuento"  data-sortable="true">Descuento</th>
                <th data-field="total" data-sortable="true">Total</th>
                <th data-field="cliente" data-sortable="true">Cliente</th>
                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Operaciones</th>
				    </tr>
				    </thead>
				</table>
			</div>
		</div>
	</div>
</div><!--/.row-->
@endsection
@section('scripts')
<script src="{{ asset('assets/js/bootstrap-table.js') }}"></script>
@endsection
