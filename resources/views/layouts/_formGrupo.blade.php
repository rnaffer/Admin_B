<fieldset>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="nombre">Nombre Del Grupo</label>
				<div class="col-md-10">
				<input required id="nombre" name="nombre" type="text" placeholder="Ingresa el nombre" class="form-control" value="@if(isset($grupo)){{ $grupo->nombre }}@endif">
				</div>
			</div>
    </div>
  </div>
	<div class="col-md-4">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="codigo">Código del grupo</label>
				<div class="col-md-10">
				<input required id="codigo" name="codigo" type="text" placeholder="Ingresa el código" class="form-control" value="@if(isset($grupo)){{ $grupo->codigo }}@else{{ $codigo }}@endif">
				</div>
			</div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-4 ">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="tipo">Tipo</label>
        <div class="col-md-10">
					<select required id="tipo" class="form-control" name="tipo">
            <option disabled @if(!isset($grupo)) selected @endif>Selecciona un tipo</option>
            <option @if(isset($grupo)) {{ $grupo->tipo == 1 ? 'selected' : '' }} @endif value="1">Padre</option>
            <option @if(isset($grupo)) {{ $grupo->tipo != 1 ? 'selected' : '' }} @endif value="2">Hijo</option>
					</select>
        </div>
      </div>
    </div>
	</div>
	<div id="grupo_padre" class="col-md-4" style="display: none;">
		<div class="row">
			<div class="form-group">
				<label class="col-md-10 control-label left" for="padre">Categoría</label>
				<div class="col-md-10">
					<select id="padre" class="form-control" name="padre">
						<option disabled selected>Selecciona a el padre</option>
						@foreach ($padres as $padre)
							<option @if(isset($grupo)) {{ $grupo->tipo == $padre->id ? 'selected' : '' }} @endif value="{{ $padre->id }}">{{ $padre->nombre }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
  @if(isset($grupo)) <input type="hidden" name="edit" value="true"> @endif
	<!-- Form actions -->
  <div class="col-md-12">
    <div class="row">
      <div class="form-group">
				<div class="col-lg-10">
          <button type="submit" class="btn btn-primary btn-md pull-left">{{ $accion }}</button>
          <a href="{{ route('grupos') }}" class="btn btn-primary btn-md pull-left" style="margin-left: 10px;">Cancelar</a>
				</div>
			</div>
    </div>
  </div>
</fieldset>