@extends('layouts.main')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading "> Facturación</div>
      <div class="panel-body">
        @include('common.errors')
        <form id="form_factura" class="form-horizontal" action="{{ route('facturas_guardar') }}" method="POST">
          {{ csrf_field() }}
          @include('layouts._formFactura')
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  
</script>
<script src="{{ asset('assets/js/bootstrap-table.js') }}"></script>
<script src="{{ asset('assets/js/facturas.js') }}"></script>
@endsection