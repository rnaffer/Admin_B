@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12">
  	<div class="panel panel-default">
  		<div class="panel-heading "> Modifique los datos del Producto</div>
  		<div class="panel-body">
        @include('common.errors')
  			<form id="form_grupo" class="form-horizontal" action="{{ route('productos_guardar') }}" method="POST">
          {{ csrf_field() }}
          @include('layouts._formProducto')  				
  			</form>
  		</div>
  	</div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $('#codigo').on('keyup', function( evt ) {
    var value = $( this ).val();

    if ( value == '' ) {
      $('#mensaje').html('');
      return;
    }

    var url = "{{ route('productos') }}/api/existe/" + value;

    $.get( url ).done(function(data) {
      if ( data.existe == true ) {
        $('#mensaje').css('color', '#D44A34');
        $('#mensaje').html('Este código ya existe.');
      } else {
        $('#mensaje').css('color', '#4DAA3F');
        $('#mensaje').html('Código Válido.');
      }
    });
  });

  $('#padre').on('change', function( evt ) {
    var value = $(this).val();
    var $hijo = $('#hijo');

    $hijo.html('<option disabled selected>Selecciona una sub-categoria</option>');
    var url = "{{ route('grupos') }}/api/hijos/" + value;

    $.get( url ).done(function(data) {
      $.each(data, function( index, grupo ) {
        $hijo.append('<option value="' + grupo.codigo + '">' + grupo.nombre + '</option>');
      });
    });
  });
</script>
@include('common.openlist')
@endsection
