@extends('layouts.main')

@section('content')
<div class="row">
  @include('common.success')
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><a href="{{ route('grupos_nuevo') }}" class="btn btn-primary btn-md">Crear Nuevo Grupo</a></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Tabla De Grupos</div>
			<div class="panel-body">
        <script type="text/javascript">
          function operateFormatter(value, row, index) {
            return [
                '<a class="edit ml10" href="javascript:void(0)" title="Editar">',
                    '<i class="glyphicon glyphicon-list-alt"></i>',
                '</a>',
                '<a class="remove ml10" href="javascript:void(0)" title="Eliminar">',
                    '<i class="glyphicon glyphicon-trash"></i>',
                '</a>'
            ].join('');
          }

          window.operateEvents = {
              'click .edit': function (e, value, row, index) {
                window.location.assign("{{ route('grupos') }}/editar/" + row.codigo);
              },
              'click .remove': function (e, value, row, index) {
                var r = confirm("¿Seguro que deseas eliminar el distribuidor?");
                if (r == true) {
                  window.location.assign("{{ route('grupos') }}/eliminar/" + row.codigo);
                } else {
                }
              }
          };
        </script>
				<table data-toggle="table" data-url="{{ route('grupos.api..index') }}"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="codigo" data-sort-order="desc">
				    <thead>
				    <tr>
				        <th data-field="codigo" data-sortable="true">Código</th>
				        <th data-field="nombre"  data-sortable="true">Nombre</th>
                <th data-field="tipo" data-sortable="true">Tipo</th>
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
