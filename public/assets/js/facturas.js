;(function () {

	var Factura = {

		prefix: '',

		//
		esPrimero: true,

		// Elements
		$displayList: $('.display-list'),
		$userList: $('#userList'),
		$searchInputs: $('.search'),
		$addButton: $('#agregar'),
		$itemList: [],
		$primero: $('#primero'),
		$codigo: $('#codigo'),
		$proveedor: $('#proveedor'),
		$fecha: $('#fecha'),
		$concepto: $('#concepto'),
		$factura: $('#factura'),
		$observacion: $('#observacion'),
		$producto: $('#producto'),
		$costo: $('#costo'),
		$cantidad: $('#cantidad'),

		$subtotal: $('#subtotal'),
		$total: $('#total'),
		$iva: $('#iva'),

		// For operations
		subtotal: 0,
		total: 0,
		iva: 0,
		productosRep: [],
		detallesFactura: [],

		// Current entities
		currentClient: {},
		currentProduct: {},
		currentSeller: {},

		// Repositories
		usersRepository: [],
		productsRepository: [],
		sellersRepository: [],


		init: function () {
			
			this.setTokenToAjax();
			this.loadRepositories( this );
			this.prepareEvents( this );

		},

		setTokenToAjax: function () {

			$.ajaxSetup({
		    headers: {
		      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
			});
		},

		prepareEvents: function ( self ) {
			
			// when user click on display list button
			self.$displayList.on('click', function ( evt ) {

				evt.preventDefault();

				var $list = $(this).next();

				self.toggleList( $list, self );
			});
			
			// when user write inside a search input
			self.$searchInputs.on('keyup', function ( evt ) {

				evt.preventDefault();

				var input = $( this );

				var filteredRepository = self.filterRepository( input.attr('id'), input.val().toLowerCase() , self );

				var list = input.parent().find('.list');

				var type = input.attr('id');

				self.insertHtmlInList( list, self.generateListHtml( filteredRepository, type ) );

				self.$itemList = $('.list-item');

				self.setEventToNewItems( self );

				self.openList( list );

			});

			// when user add a product
			self.$addButton.on('click', function ( evt ) {

				evt.preventDefault();

				var datos = {};

				datos.codigo = self.$codigo.val();
				datos.cliente = self.currentClient.id;
				datos.vendedor = self.currentSeller.id;
				datos.producto = self.currentProduct.id;
				datos.costo = self.$costo.val();
				datos.cantidad = self.$cantidad.val();

				if ( !self.isValid(datos) ) {

					alert('Por favor verifica que has llenado todos los campos.');
					return;

				}

				$.post( self.prefix + '/facturas/api/agregar', datos)
				.done(function(data) {

					if (data.status == 'ok') {

						self.esPrimero = false;

						var subtotalLocal = parseInt(self.$cantidad.val()) * parseFloat(self.$costo.val());
						// cargar de forma dinamica
						var ivaLocal = subtotalLocal * 16 / 100;
						var totalLocal = ivaLocal + subtotalLocal;

						self.agregarDetalle({codigo: data.codigo, subtotal: subtotalLocal, iva: ivaLocal, total: totalLocal}, self);
					}
				});
			});
		},

		setEventToNewItems: function ( self ) {

			self.$itemList.on('click', function ( evt ) {

				evt.preventDefault();

				var $item = $( this ),
						$list = $item.parent();

				var nombre = $item.attr('data-nombre'),
						id = $item.attr('data-id'); 

				$list.parent().find('input').val(decodeURI(nombre));

				if ( $list.attr('id') == 'userList' ) {

					var nit = $item.attr('data-nit');
					var name = $item.attr('data-nombre');
					var tipo_lista = $item.attr('data-tipolista');

					$('#ruc').val(nit);
					$('#nombre').val(name);

					self.currentClient = { 'id': id, 'nombre': nombre, 'nit': nit, 'list_type': tipo_lista };
					
				}

				if ( $list.attr('id') == 'productList' ) {

					var pvp = 'data-pvp' + self.currentClient.list_type;

					var costo = $item.attr(pvp);

					$('#costo').val(costo);

					self.currentProduct = { 'id': id, 'nombre': nombre, 'costo': costo };
					
				}

				if ( $list.attr('id') == 'vendedorList' ) {

					self.currentSeller = { 'id': id, 'nombre': nombre };
					
				}

				self.closeList( $list );

			});
			
		},

		loadRepositories: function ( self ) {

			// load users repository
			self.fillRepository( self.prefix + '/clientes/getdata', 'usersRepository', self, function () {
				
				self.insertHtmlInList( $('#userList'), self.generateListHtml( self.usersRepository, 'cliente' ));

				self.$itemList = $('.list-item');

				self.setEventToNewItems( self );

			});

			// Load sellers repository
			self.fillRepository( self.prefix + '/vendedores/getdata', 'sellersRepository', self, function () {
				
				self.insertHtmlInList( $('#vendedorList'), self.generateListHtml( self.sellersRepository, 'vendedor' ));

				self.$itemList = $('.list-item');

				self.setEventToNewItems( self );

			});
			// load products repository
			self.fillRepository( self.prefix + '/productos/getdata', 'productsRepository', self, function () {
				
				self.insertHtmlInList( $('#productList'), self.generateListHtml( self.productsRepository, 'producto' ));

				self.$itemList = $('.list-item');

				self.setEventToNewItems( self );

			});
		},

		filterRepository: function ( id, searchValue, self ) {
			
			var temporalRepository = [],
					finalRepository = [];

			if ( id == 'cliente' ) {

				temporalRepository = self.usersRepository;

			} else if( id == 'vendedor' ) {

				temporalRepository = self.sellersRepository;

			} else if ( id == 'producto' ) {

				temporalRepository = self.productsRepository;

			}

			finalRepository = temporalRepository.filter( function ( obj ) {

				if ( !isNaN( searchValue )) {

					return obj.id.toString().indexOf( searchValue.toString() ) !== -1 ? true : false;

				} else if( isNaN( searchValue ) ) {

					return obj.nombre.toLowerCase().indexOf(searchValue) !== -1 ? true : false;
				}

				return false;
			});

			if ( finalRepository.length < 1 ) {

				return temporalRepository;

			}

			return finalRepository;
		},

		agregarDetalle: function ( producto ) {
			
			this.detallesFactura.push( producto );

			this.calcularDatosDeFactura();
		},

		calcularDatosDeFactura: function () {

			var total = 0,
					subtotal = 0,
					iva = 0;

			$.each( this.detallesFactura, function( index, producto ) {

				subtotal += producto.subtotal;
				iva += producto.iva;
				total += producto.total;

			});

			this.total = total;
			this.iva = iva;
			this.subtotal = subtotal;

			this.mostrarDatosDeFactura();
		},

		mostrarDatosDeFactura: function () {

			this.$subtotal.html(this.subtotal);
			this.$iva.html(this.iva);
			this.$total.html(this.total);

			$('#Eiva').val(this.iva);
			$('#Esubtotal').val(this.subtotal);
			$('#Etotal').val(this.total);

			$('#table').bootstrapTable('refresh', {silent: true});
		},

		eliminarDetalle: function ( codigo ) {

			for (var i = 0; i < this.detallesFactura.length; i++) {

				if ( this.detallesFactura[i].codigo == codigo ) {

					this.detallesFactura.splice( i, 1 );

					this.calcularDatosDeFactura();

					return;
				}				
			}
		},

		openList: function ( listElement ) {

			$label = listElement.prev().find('span');

			if ( !listElement.hasClass('open') ) {

				$label.removeClass('glyphicon-chevron-down');
				$label.addClass('glyphicon-chevron-up');

				listElement.addClass('open');				
			}
		},

		closeList: function ( listElement ) {

			$label = listElement.prev().find('span');

			if ( listElement.hasClass('open') ) {

				$label.removeClass('glyphicon-chevron-up');
				$label.addClass('glyphicon-chevron-down');

				listElement.removeClass('open');				
			}
		},

		toggleList: function ( listElement, self ) {
			
			// listElement.hasClass('open') ? self.closeList( listElement ) : self.openList( listElement );
			if (listElement.hasClass('open')) {
				self.closeList( listElement );
			} else {
				self.openList( listElement );
			}
		},

		fillRepository: function ( url, repository, self, callback ) {

			$.get( url )
			 .done( function( data ) {

			 	self[repository] = data;

			 	callback();

			 });
		},

		generateListHtml: function ( repository, type ) {

			var html = '';

			$.each( repository, function ( index, item ) {

				var itemHtml = '';

				if ( type == 'cliente' ) {

					itemHtml = '<div class="list-item" data-id="' + item.id + '" data-nombre="' + item.nombre + '" data-nit="' + item.nit +
										 '" data-tipolista="' + item.tipo_lista + '">' +
												'<div class="w_10 list-data index">' + item.id + '</div>' +
												'<div class="w_80 list-data data">' + item.nombre + '</div>' +
											'</div>';

				} else if( type == 'producto' ) {

					itemHtml = '<div class="list-item" data-id="' + item.id + '" data-nombre="' + encodeURI(item.nombre) + '" data-pvp1="' + item.pvp1 + 
										 '" data-pvp2="' + item.pvp2 + '" data-pvp3="' + item.pvp3 + '" data-pvp4="' + item.pvp4 + '" data-pvp5="' + item.pvp5 + '">' +
												'<div class="w_10 list-data index">' + item.id + '</div>' +
												'<div class="w_80 list-data data">' + item.nombre + '</div>' +
											'</div>';
				} else {

					itemHtml = '<div class="list-item" data-id="' + item.id + '" data-nombre="' + item.nombre + '">' +
												'<div class="w_10 list-data index">' + item.id + '</div>' +
												'<div class="w_80 list-data data">' + item.nombre + '</div>' +
											'</div>';	
				}

				html += itemHtml;
			});

			return html;			
		},

		insertHtmlInList: function ( list, html ) {

			list.html( html );
			
		},

		isValid: function ( datos ) {

			if ( datos.codigo === '' || datos.cliente === undefined ||
					 datos.vendedor === undefined || datos.producto === undefined ||
					 datos.costo === '' || datos.costo < 1 ||
					 datos.canidad < 1 || datos.cantidad === '') {

				return false;
			}

			return true;
		}
	};

	window.Factura = Factura;
	window.Factura.init();

})(); 