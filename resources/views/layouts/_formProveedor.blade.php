<fieldset>
	<div class="col-md-4">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="codigo">Código Proveedor</label>
				<div class="col-md-10">
				<input required readonly id="Ncodigo" name="Ncodigo" type="text" placeholder="Ingresa el código" class="form-control" value="@if(isset($proveedor)){{ $proveedor->codigo }}@else{{ $codigo }}@endif">
        <input type="hidden" id="codigo" name="codigo" value="@if(isset($proveedor)){{ $proveedor->codigo }}@else{{ $codigo }}@endif">
				</div>
			</div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="nombre">Razón Social</label>
        <div class="col-md-10">
          <input required id="nombre" name="nombre" type="text" placeholder="Ingresa la razón social" class="form-control" value="@if(isset($proveedor)){{ $proveedor->nombre }}@endif">
        </div>
      </div>
    </div>
  </div>
	<div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="ruc">Cédula/NIT</label>
        <div class="col-md-10">
          <input required id="ruc" name="ruc" type="text" placeholder="Ingresa el NIT" class="form-control" value="@if(isset($proveedor)){{ $proveedor->ruc }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-4">
		<div class="row">
			<div class="form-group">
				<label class="col-md-10 control-label left" for="estado">Estado</label>
				<div class="col-md-10">
					<select required id="estado" class="form-control" name="estado">
						<option disabled selected>Selecciona un estado</option>
              @foreach ($estados as $estado)
                <option @if(isset($proveedor)) {{ $estadoProveedor->id == $estado->id ? 'selected' : '' }} @endif value="{{ $estado->id }}">{{ $estado->estado }}</option>
              @endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="ciudad">Ciudad</label>
        <div class="col-md-10">
          <select required id="ciudad" class="form-control" name="ciudad">
            <option disabled selected>Selecciona primero un estado</option>
            @if(isset($proveedor))
              @foreach ($ciudades as $ciudad)
                <option @if(isset($proveedor)) {{ $proveedor->ciudad_id == $ciudad->id ? 'selected' : '' }} @endif value="{{ $ciudad->id }}">{{ $ciudad->ciudad }}</option>
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
        <label class="col-md-10 control-label left" for="telefono">Teléfono</label>
        <div class="col-md-10">
          <input required id="telefono" name="telefono" type="text" placeholder="Ingresa el telefono" class="form-control" value="@if(isset($proveedor)){{ $proveedor->telefono }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="celular">Celular</label>
        <div class="col-md-10">
          <input id="celular" name="celular" type="text" placeholder="Ingresa el celular" class="form-control" value="@if(isset($proveedor)){{ $proveedor->celular }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="email">Email</label>
        <div class="col-md-10">
          <input id="email" name="email" type="email" placeholder="Ingresa el email" class="form-control" value="@if(isset($proveedor)){{ $proveedor->email }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="direccion">Derección</label>
        <div class="col-md-10">
          <input required id="direccion" name="direccion" type="text" placeholder="Ingresa la dirección" class="form-control" value="@if(isset($proveedor)){{ $proveedor->direccion }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="observacion">Observaciones</label>
        <div class="col-md-10">
          <input id="observacion" name="observacion" type="text" placeholder="Ingresa la observacion" class="form-control" value="@if(isset($proveedor)){{ $proveedor->observacion }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="fecha">Fecha Ingreso</label>
        <div class="col-md-10">
          <input required id="fecha" name="fecha" type="text" class="form-control" value="@if(isset($proveedor)){{ $proveedor->created_at }}@else{{ date('d/m/Y') }}@endif">
        </div>
      </div>
    </div>
  </div>
  @if(isset($proveedor)) <input type="hidden" name="edit" value="true"> @endif
	<!-- Form actions -->
  <div class="col-md-12">
    <div class="row">
      <div class="form-group">
				<div class="col-lg-10">
          <button type="submit" class="btn btn-primary btn-md pull-left">{{ $accion }}</button>
          <a href="{{ route('proveedores') }}" class="btn btn-primary btn-md pull-left" style="margin-left: 10px;">Cancelar</a>
				</div>
			</div>
    </div>
  </div>
</fieldset>