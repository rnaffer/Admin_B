@extends('layouts.main')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel='stylesheet' type='text/css' href="{{ asset('assets/css/chosen.min.css') }}">
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading "> Entrada de mercancía</div>
      <div class="panel-body">
        @include('common.errors')
        <form id="form_entrada" class="form-horizontal" action="{{ route('entradas_guardar') }}" method="POST">
          {{ csrf_field() }}
          @include('layouts._formEntrada')
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
<script src="{{ asset('assets/js/entradas.js') }}"></script>
@include('common.openlist')
@endsection