@extends('layouts.main')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading "> Consulte los documentos de las entradas al almacén.</div>
      <div class="panel-body">
        @include('common.errors')
        <form id="form_bEntrada" class="form-horizontal" action="" method="POST">
          {{ csrf_field() }}
          <fieldset>            
            <div class="col-md-4">
              <div class="row">
                <div class="form-group">
                  <label class="col-md-10 control-label left" for="fechaI">Fecha Inicial</label>
                  <div class="col-md-10">
                    <input id="fechaI" name="fechaI" type="text" class="form-control">
                  </div>
                </div>
              </div>
            </div>
             <div class="col-md-4">
              <div class="row">
                <div class="form-group">
                  <label class="col-md-10 control-label left" for="fechaF">Fecha Final</label>
                  <div class="col-md-10">
                    <input id="fechaF" name="fechaF" type="text" class="form-control" value="{{ date('Y-m-d') }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
              <div class="row">
                <div class="form-group">
                  <label class="col-md-10 control-label left" for="proveedor">Proveedor</label>
                  <div class="col-md-10">
                    <select id="proveedor" class="form-control" name="proveedor">
                      <option disabled selected>Selecciona un proveedor</option>
                      @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>            
            <div class="col-md-12" style="border-bottom: 1px solid #EEE; margin: 10px 0;"></div>
            <div class="col-md-12">
              <div class="row">
                <div class="form-group">
                  <div class="col-lg-10">
                    <button type="submit" class="btn btn-primary btn-md pull-left">{{ $accion }}</button>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<div id="search_box" class="row" style="display: none;">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">Resultados de la busqueda.</div>
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
        <table id="table" data-toggle="table" data-url="{{ route('entradas_api') }}"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="updated_at" data-sort-order="desc">
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
<script type="text/javascript">

;(function () {

  var defaultUrl = "{{ route('entradas_api') }}",
      url = '';

  $('#form_bEntrada').on('submit', function ( evt ) {

    evt.preventDefault();

    var date1 =     $('#fechaI').val(),
        date2 =     $('#fechaF').val(),
        proveedor = $('#proveedor').val();
    
    url =  defaultUrl + '/';
    url += ( date1 === '' ) ? '1990-01-01/' : date1 + '/'; 
    url += ( date2 === '' ) ? "{{ date('Y-m-d') }}/" : date2 + '/'; 
    url += ( proveedor === null ) ? '0' : proveedor;

    $('#search_box').fadeIn('fast', function() {

      var $table = $('#table');
      $table.bootstrapTable('refresh', {silent: true, url: url});
    });
  });

})();

</script>
@include('common.openlist')
@endsection