@extends('layouts.main')

@section('content')
<div class="row">
  @include('common.success')
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><a href="{{ route('entradas_nuevo') }}" class="btn btn-primary btn-md">Crear Nueva Entrada</a></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Tabla De Entradas</div>
			<div class="panel-body">
        <script type="text/javascript">
          function operateFormatter(value, row, index) {
            return [
                '<a class="edit ml10" href="javascript:void(0)" title="Editar">',
                    '<i class="glyphicon glyphicon-list-alt"></i>',
                '</a>'
            ].join('');
          }

          window.operateEvents = {
              'click .edit': function (e, value, row, index) {
                window.location.assign("/entradas/pdf/" + row.codigo);
              }
          };
        </script>
				<table data-toggle="table" data-url="{{ route('entradas_api') }}"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="updated_at" data-sort-order="desc">
				    <thead>
				    <tr>
				        <th data-field="codigo" data-sortable="true">Entrada</th>
                <th data-field="concepto"  data-sortable="true">Concepto</th>
				        <th data-field="updated_at"  data-sortable="true">Fecha</th>
                <th data-field="total" data-sortable="true">Total</th>
                <th data-field="proveedor" data-sortable="true">Proveedor</th>
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
@include('common.openlist')
@endsection
