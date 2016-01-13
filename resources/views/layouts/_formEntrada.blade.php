<fieldset>
	<div class="col-md-4">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="codigo">N° de Entrada</label>
				<div class="col-md-10">
					<input required readonly id="Ncodigo" name="Ncodigo" type="text" placeholder="" class="form-control" value="E{{ $codigo }}">
					<input type="hidden" id="codigo" name="codigo" value="{{ $codigo }}">
				</div>
			</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
        <label class="col-md-10 control-label left" for="fecha">Fecha</label>
        <div class="col-md-10">
          <input required id="fecha" name="fecha" type="hidden" class="form-control" value="{{ date('d/m/Y') }}">
          <input readonly id="nfecha" name="nfecha" type="text" class="form-control" value="{{ date('d/m/Y') }}">
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
  <div class="col-md-4">
		<div class="row">
			<div class="form-group">
				<label class="col-md-10 control-label left" for="concepto">Concepto</label>
				<div class="col-md-10">
					<select id="concepto" class="form-control" name="concepto">
						<option disabled selected>Selecciona un concepto</option>					
						<option value="EA">EA: Entrada Almacén</option>					
						<option value="TS">TS: Translado de Mercancía</option>					
						<option value="AE">AE: Ajuste al Inventario</option>					
					</select>
				</div>
			</div>
		</div>
	</div>
  <div class="clearfix"></div>
	<div class="col-md-4">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="factura">N° Factura de compra</label>
				<div class="col-md-10">
				<input id="factura" name="factura" type="text" placeholder="Ingresa el n° de la factura" class="form-control" value="">
				</div>
			</div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="observacion">Observación</label>
				<div class="col-md-10">
				<input id="observacion" name="observacion" type="text" placeholder="Ingresa la observacion" class="form-control" value="">
				</div>
			</div>
    </div>
  </div>
  <div class="col-md-12" style="border-bottom: 1px solid #EEE; margin-bottom: 10px;"></div>
  <div class="clearfix"></div>
  <div class="col-md-4">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="producto">Busqueda de productos</label>
				<div class="col-md-10">
					<input required id="producto" name="producto" type="text" placeholder="Nombre o Id del producto" class="form-control search" value="">
					<div class="display-list"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true" style="line-height: 2;"></span></div>
					<div id="productList" class="list">
						
					</div>
				</div>
			</div>
    </div>
  </div>
	<!-- Form actions -->
	<div class="col-md-3">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="costo">Costo</label>
				<div class="col-md-10">
				<input required id="costo" name="costo" type="number" placeholder="Costo del producto" class="form-control" value="">
				</div>
			</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="cantidad">Cantidad</label>
				<div class="col-md-10">
				<input required id="cantidad" name="cantidad" type="number" placeholder="Cantidad" class="form-control" value="">
				</div>
			</div>
    </div>
  </div>
  <div class="col-md-2">
		<div class="row">
			<div class="form-group"></div>
  			<a id="agregar" href="" class="btn btn-primary btn-md m_top_12">Agregar</a>
		</div>
	</div>
  <div class="col-md-12" style="border-bottom: 1px solid #EEE; margin: 10px 0;"></div>
  <div class="col-lg-12" style="padding: 0;">
		<div class="panel panel-default">
			<div class="panel-heading" style="padding: 10px 0;">Detalle de Compra</div>
			<div class="panel-body" style="padding: 10px 0px;">
        <script type="text/javascript">
          function operateFormatter(value, row, index) {
            return [
                '<a class="edit ml10" href="javascript:void(0)" title="Editar">',
                    '<i class="glyphicon glyphicon-remove"></i>',
                '</a>'
            ].join('');
          }

          window.operateEvents = {
              'click .edit': function (e, value, row, index) {
              	$.get("{{ route('entradas') }}/api/detalle/eliminar/" + row.id)
								 .done(function(data) {
								 	if (data.status == 'ok') {

										window.Entradas.eliminarDetalle( row.id );
								 	};
								 });
              }
          };
        </script>
				<table id="table" data-toggle="table" data-url="{{ route('entradas_detalle', ['id' => $codigo]) }}"  data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="codigo" data-sort-order="desc">
				    <thead>
				    <tr>
				        <th data-field="index" data-sortable="true">Item</th>
				        <th data-field="id" data-sortable="true">Código</th>
				        <th data-field="nombre"  data-sortable="true">Producto</th>
                <th data-field="costo_unitario" data-sortable="true">Precio</th>
                <th data-field="cantidad" data-sortable="true">Cantidad</th>
                <th data-field="subtotal" data-sortable="true">Subtotal</th>
                <th data-field="flete" data-sortable="true">Val con flete</th>
                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Op.</th>
				    </tr>
				    </thead>
				</table>
				<div class="row" style="margin: 0px;">
					<div class="col-md-3 col-md-offset-5">
						<div class="row grey_bottom">
							<div class="col-md-4 grey_right pad_5">Flete</div>
							<div class="col-md-8">
								<input required id="flete" name="flete" type="number" placeholder="Ingresar monto" class="form-control" value="">
							</div>
						</div>
						<div class="row grey_bottom">
							<div class="col-md-12 pad_5">
								<a id="calcFlete" href="#" class="btn btn-primary">Calcular Flete</a>
							</div>
						</div>
				  </div>
					<div class="col-md-4 total-box">
						<div class="row grey_bottom">
							<div class="col-md-6 grey_right pad_5">Sub-Total:</div>
							<div id="subtotal" class="col-md-6"></div>
						</div>
						<div class="row grey_bottom">
							<div class="col-md-6 grey_right pad_5">IVA:</div>
							<div id="iva" class="col-md-6"></div>
						</div>
						<div class="row grey_bottom">
							<div class="col-md-6 grey_right pad_5">Total:</div>
							<div id="total" class="col-md-6"></div>
						</div>
						<div class="row">
							<div class="col-md-6 grey_right pad_5">Con flete:</div>
							<div id="totalConFlete" class="col-md-6"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  <input id="primero" type="hidden" name="primero" value="true">
  <input id="Esubtotal" type="hidden" name="Esubtotal" value="0">
  <input id="Eiva" type="hidden" name="Eiva" value="0">
  <input id="Etotal" type="hidden" name="Etotal" value="0">
  <div class="col-md-12">
    <div class="row">
      <div class="form-group">
				<div class="col-lg-10">
          <button type="submit" class="btn btn-primary btn-md pull-left">{{ $accion }}</button>
          <a href="{{ route('entradas') }}" class="btn btn-primary btn-md pull-left" style="margin-left: 10px;">Cancelar</a>
				</div>
			</div>
    </div>
  </div>
</fieldset>