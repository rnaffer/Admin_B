<fieldset>
	<div class="col-md-4">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="codigo">Factura N°</label>
				<div class="col-md-10">
					<input required readonly id="Ncodigo" name="Ncodigo" type="text" placeholder="" class="form-control" value="F{{ $codigo }}">
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
				<label class="col-md-10 control-label left" for="cliente">Cliente</label>
				<div class="col-md-10">
					<input required id="cliente" name="cliente" type="text" placeholder="Nombre o Id del cliente" class="form-control search" value="">
					<div class="display-list"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true" style="line-height: 2;"></span></div>
					<div id="userList" class="list">						
					</div>	
				</div>				
			</div>
		</div>
	</div> 	
	<div class="col-md-4">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="nombre">Nombre del Cliente</label>
				<div class="col-md-10">
					<input required id="nombre" name="nombre" type="text" placeholder="" class="form-control" value="">
				</div>
			</div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="row">
      <div class="form-group">
				<label class="col-md-10 control-label left" for="ruc">NIT/CC</label>
				<div class="col-md-10">
				<input required id="ruc" name="ruc" type="text" placeholder="" class="form-control" value="">
				</div>
			</div>
    </div>
  </div>
  <div class="col-md-2">
		<div class="row">
			<div class="form-group"></div>
  			<a id="crear" href="{{ route('clientes_nuevo') }}" class="btn btn-primary btn-md pull-left m_top_12">Crear Cliente</a>
		</div>
	</div>
  <div class="clearfix"></div>
  <div class="col-md-4">
		<div class="row">
			<div class="form-group">
				<label class="col-md-10 control-label left" for="vendedor">Vendedor</label>
				<div class="col-md-10">
					<input required id="vendedor" name="vendedor" type="text" placeholder="Nombre o Id del vendedor" class="form-control search" value="">
					<div class="display-list"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true" style="line-height: 2;"></span></div>
					<div id="vendedorList" class="list">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="row">
			<div class="form-group">
				<label class="col-md-10 control-label left" for="forma">Forma Pago</label>
				<div class="col-md-10">
					<select id="forma" class="form-control" name="forma">
						<option selected value="1">Efectivo</option>					
						<option value="2">T. Crédito</option>					
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="row">
			<div class="form-group">
				<label class="col-md-10 control-label left" for="modo">Modo Pago</label>
				<div class="col-md-10">
					<select id="modo" class="form-control" name="modo">
						<option disabled>Selecciona una modo de pago</option>					
						<option selected value="1">Contado</option>					
						<option value="2">Crédito</option>					
					</select>
				</div>
			</div>
		</div>
	</div>
  <div class="clearfix"></div>
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
			<div class="panel-heading" style="padding: 10px 0;">Detalle de Factura</div>
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
              	$.get("{{ route('facturas') }}/api/detalle/eliminar/" + row.id)
								 .done(function(data) {
								 	if (data.status == 'ok') {

										window.Factura.eliminarDetalle( row.id );
								 	};
								 });
              }
          };
        </script>
				<table id="table" data-toggle="table" data-url="{{ route('facturas_detalle', ['id' => $codigo]) }}"  data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="codigo" data-sort-order="desc">
				    <thead>
				    <tr>
				        <th data-field="index" data-sortable="true">Item</th>
				        <th data-field="id" data-sortable="true">Código</th>
				        <th data-field="nombre"  data-sortable="true">Producto</th>
                <th data-field="costo_unitario" data-sortable="true">Precio</th>
                <th data-field="cantidad" data-sortable="true">Cantidad</th>
                <th data-field="subtotal" data-sortable="true">Subtotal</th>
                <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Operaciones</th>
				    </tr>
				    </thead>
				</table>
				<div class="row" style="margin: 0px;">
					<div class="col-md-4">
				    <div class="row">
				      <div class="form-group">
								<label class="col-md-10 control-label left" for="descuento">Dcto.</label>
								<div class="col-md-10">
									<select data-placeholder="Selecciona un descuento" id="descuento" class="form-control " name="descuento">
										<option selected>Ninguno</option>
										<option value="3">3</option>
										<option value="5">5</option>
										<option value="10">10</option>
									</select>
								</div>
							</div>
				    </div>
				  </div>
					<div class="col-md-4 col-md-offset-4 total-box">
						<div class="row grey_bottom">
							<div class="col-md-6 grey_right pad_5">Sub-Total:</div>
							<div id="subtotal" class="col-md-6"></div>
						</div>
						<div class="row grey_bottom">
							<div class="col-md-6 grey_right pad_5">IVA:</div>
							<div id="iva" class="col-md-6"></div>
						</div>
						<div class="row">
							<div class="col-md-6 grey_right pad_5">Total:</div>
							<div id="total" class="col-md-6"></div>
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
          <a href="{{ route('facturas') }}" class="btn btn-primary btn-md pull-left" style="margin-left: 10px;">Cancelar</a>
				</div>
			</div>
    </div>
  </div>
</fieldset>