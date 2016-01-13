<fieldset>
	<div class="col-md-4">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="codigo">Código</label>
				<div class="col-md-10">
				<input required id="codigo" name="codigo" type="text" placeholder="Ingresa el código" class="form-control" value="@if(isset($producto)){{ $producto->codigo }}@else{{ $codigo }}@endif">
				</div>
			</div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="row">
      <div class="form-group">
				<p id="mensaje" class="col-md-10" style="padding-top: 30px; color: #4DAA3F;">
				  Código válido. Generado Automaticamente.
				</p>
			</div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="nombre">Nombre</label>
        <div class="col-md-10">
          <input required id="nombre" name="nombre" type="text" placeholder="Ingresa el nombre" class="form-control" value="@if(isset($producto)){{ $producto->nombre }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="descripcion">Descripción</label>
        <div class="col-md-10">
          <input required id="descripcion" name="descripcion" type="text" placeholder="Ingresa la descripcion" class="form-control" value="@if(isset($producto)){{ $producto->descripcion }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
	<div class="col-md-4">
		<div class="row">
			<div class="form-group">
				<label class="col-md-10 control-label left" for="padre">Categoría</label>
				<div class="col-md-10">
					<select required id="padre" class="form-control" name="padre">
						<option disabled selected>Selecciona a el padre</option>
						@foreach ($padres as $padre)
							<option @if(isset($producto)) {{ $padreGrupo->id == $padre->id ? 'selected' : '' }} @endif value="{{ $padre->id }}">{{ $padre->nombre }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
  <div class="col-md-4">
		<div class="row">
			<div class="form-group">
				<label class="col-md-10 control-label left" for="hijo">Sub Categoría</label>
				<div class="col-md-10">
					<select required id="hijo" class="form-control" name="hijo">
						<option disabled selected>Selecciona primero al padre</option>
            @if(isset($producto))
              @foreach ($hijos as $hijo)
                <option @if(isset($producto)) {{ $producto->marca_id == $hijo->codigo ? 'selected' : '' }} @endif value="{{ $hijo->codigo }}">{{ $hijo->nombre }}</option>
              @endforeach
            @endif
					</select>
				</div>
			</div>
		</div>
	</div>
  <div class="clearfix"></div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="costo">Costo</label>
        <div class="col-md-10">
          <input required id="costo" name="costo" type="number" placeholder="Ingresa el costo" class="form-control" value="@if(isset($producto)){{ $producto->costo }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="pvp1">PVP1</label>
        <div class="col-md-10">
          <input required id="pvp1" name="pvp1" type="number" placeholder="Ingresa el pvp1" class="form-control" value="@if(isset($producto)){{ $producto->pvp1 }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="pvp2">PVP2</label>
        <div class="col-md-10">
          <input required id="pvp2" name="pvp2" type="number" placeholder="Ingresa el pvp2" class="form-control" value="@if(isset($producto)){{ $producto->pvp2 }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="pvp3">PVP3</label>
        <div class="col-md-10">
          <input required id="pvp3" name="pvp3" type="number" placeholder="Ingresa el pvp3" class="form-control" value="@if(isset($producto)){{ $producto->pvp3 }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="pvp4">PVP4</label>
        <div class="col-md-10">
          <input id="pvp4" name="pvp4" type="number" placeholder="Ingresa el pvp4" class="form-control" value="@if(isset($producto)){{ $producto->pvp4 }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="pvp5">PVP5</label>
        <div class="col-md-10">
          <input id="pvp5" name="pvp5" type="number" placeholder="Ingresa el pvp5" class="form-control" value="@if(isset($producto)){{ $producto->pvp5 }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-4">
		<div class="row">
			<div class="form-group">
				<label class="col-md-10 control-label left" for="color">Color</label>
				<div class="col-md-10">
					<select required id="color" class="form-control" name="color">
						<option disabled selected>Selecciona un color</option>
            @foreach ($colores as $color)
							<option @if(isset($producto)) {{ $producto->color == $color->id ? 'selected' : '' }} @endif value="{{ $color->id }}">{{ $color->nombre }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="fecha">Fecha Ingreso</label>
        <div class="col-md-10">
          <input required id="fecha" name="fecha" type="text" class="form-control" value="@if(isset($producto)){{ $producto->created_at }}@else{{ date('d/m/Y') }}@endif">
        </div>
      </div>
    </div>
  </div>
  @if(isset($producto)) <input type="hidden" name="edit" value="true"> @endif
	<!-- Form actions -->
  <div class="col-md-12">
    <div class="row">
      <div class="form-group">
				<div class="col-lg-10">
          <button type="submit" class="btn btn-primary btn-md pull-left">{{ $accion }}</button>
          <a href="{{ route('productos') }}" class="btn btn-primary btn-md pull-left" style="margin-left: 10px;">Cancelar</a>
				</div>
			</div>
    </div>
  </div>
</fieldset>