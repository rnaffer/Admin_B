<fieldset>
	<div class="col-md-4">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="codigo">Código Cliente</label>
				<div class="col-md-10">
				<input required id="codigo" name="codigo" type="text" placeholder="Ingresa el código" class="form-control" value="@if(isset($cliente)){{ $cliente->codigo }}@else{{ $codigo }}@endif">
				</div>
			</div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="nombre">Nombre</label>
        <div class="col-md-10">
          <input required id="nombre" name="nombre" type="text" placeholder="Ingresa el nombre" class="form-control" value="@if(isset($cliente)){{ $cliente->nombre }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="apellido">Apellido</label>
        <div class="col-md-10">
          <input required id="apellido" name="apellido" type="text" placeholder="Ingresa el apellido" class="form-control" value="@if(isset($cliente)){{ $cliente->apellido }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
	<div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="ruc">Cédula/NIT</label>
        <div class="col-md-10">
          <input required id="ruc" name="ruc" type="text" placeholder="Ingresa la Cédula/NIT" class="form-control" value="@if(isset($cliente)){{ $cliente->ruc }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
		<div class="row">
			<div class="form-group">
				<label class="col-md-10 control-label left" for="estado">Estado</label>
				<div class="col-md-10">
					<select required id="estado" class="form-control" name="estado">
						<option disabled selected>Selecciona un estado</option>
              @foreach ($estados as $estado)
                <option @if(isset($cliente)) {{ $estadoCliente->id == $estado->id ? 'selected' : '' }} @endif value="{{ $estado->id }}">{{ $estado->estado }}</option>
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
            @if(isset($cliente))
              @foreach ($ciudades as $ciudad)
                <option @if(isset($cliente)) {{ $cliente->ciudad_id == $ciudad->id ? 'selected' : '' }} @endif value="{{ $ciudad->id }}">{{ $ciudad->ciudad }}</option>
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
          <input required id="telefono" name="telefono" type="text" placeholder="Ingresa el telefono" class="form-control" value="@if(isset($cliente)){{ $cliente->telefono }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="celular">Celular</label>
        <div class="col-md-10">
          <input required id="celular" name="celular" type="text" placeholder="Ingresa el celular" class="form-control" value="@if(isset($cliente)){{ $cliente->celular }}@endif">
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
          <input required id="email" name="email" type="email" placeholder="Ingresa el email" class="form-control" value="@if(isset($cliente)){{ $cliente->email }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="direccion">Derección</label>
        <div class="col-md-10">
          <input required id="direccion" name="direccion" type="text" placeholder="Ingresa la dirección" class="form-control" value="@if(isset($cliente)){{ $cliente->direccion }}@endif">
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-4">
		<div class="row">
			<div class="form-group">
				<label class="col-md-10 control-label left" for="lista">Lista Precio</label>
				<div class="col-md-10">
					<select required id="lista" class="form-control" name="lista">
						<option disabled selected>Selecciona una lista</option>
              @for ($i = 1; $i < 6; $i++)
                  <option @if(isset($cliente)) {{ $cliente->tipo_lista == $i ? 'selected' : '' }} @endif value="{{ $i }}">{{ $i }}</option>
              @endfor
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
          <input required id="fecha" name="fecha" type="text" class="form-control" value="@if(isset($cliente)){{ $cliente->created_at }}@else{{ date('d/m/Y') }}@endif">
        </div>
      </div>
    </div>
  </div>
  @if(isset($cliente)) <input type="hidden" name="edit" value="true"> @endif
	<!-- Form actions -->
  <div class="col-md-12">
    <div class="row">
      <div class="form-group">
				<div class="col-lg-10">
          <button type="submit" class="btn btn-primary btn-md pull-left">{{ $accion }}</button>
          <a href="{{ route('clientes') }}" class="btn btn-primary btn-md pull-left" style="margin-left: 10px;">Cancelar</a>
				</div>
			</div>
    </div>
  </div>
</fieldset>