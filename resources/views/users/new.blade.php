@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12">
  	<div class="panel panel-default">
  		<div class="panel-heading "> Complete los Datos para el nuevo Cliente</div>
  		<div class="panel-body">
        @include('common.errors')
  			<form id="form_grupo" class="form-horizontal" action="{{ route('clientes_guardar') }}" method="POST">
          {{ csrf_field() }}
          @include('layouts._formCliente')  				
  			</form>
  		</div>
  	</div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$('#estado').on('change', function( evt ) {
  var value = $(this).val();
  var $ciudad = $('#ciudad');

  $ciudad.html('<option disabled selected>Selecciona una ciudad</option>');
  var url = "{{ route('ciudades', ['']) }}/" + value;

  $.get( url ).done(function(data) {
    $.each(data, function( index, ciudad ) {
      $ciudad.append('<option value="' + ciudad.id + '">' + ciudad.ciudad + '</option>');
    });
  });
});
</script>
@endsection
