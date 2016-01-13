@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12">
  	<div class="panel panel-default">
  		<div class="panel-heading "> Modifique los datos a editar.</div>
  		<div class="panel-body">
        @include('common.errors')
  			<form id="form_grupo" class="form-horizontal" action="{{ route('grupos_guardar') }}" method="POST">
          {{ csrf_field() }}
          @include('layouts._formGrupo')
  			</form>
  		</div>
  	</div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $('#tipo').on('change', function( evt ) {
    if ( $(this).val() == 1 ) {
      $('#grupo_padre').fadeOut('fast');
    } else {
      $('#grupo_padre').fadeIn('fast');
    }
  });

  if ($('#tipo').val() == 2) { $('#grupo_padre').fadeIn('fast'); };
</script>
@include('common.openlist')
@endsection
