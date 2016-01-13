;(function () {

	var Entradas = {

		prefix: '',
		// Current in use
		esPrimero: true,
		fleteCalculado: false,
		producto: {},

		// current
		currentProduct: {},

		// elements
		$displayList: $('.display-list'),
		$searchInputs: $('.search'),
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
		$flete: $('#flete'),

		$subtotal: $('#subtotal'),
		$total: $('#total'),
		$iva: $('#iva'),
		$totalConFlete: $('#totalConFlete'),

		subtotal: 0,
		total: 0,
		iva: 0,

		// repositories
		productsRepository: [],
		detallesEntrada: [],

		$agregar: $('#agregar'),
		$calcularFlete: $('#calcFlete'),


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
			self.$agregar.on('click', function( evt ) {
				
				evt.preventDefault();

				var datos = {
					codigo: self.$codigo.val(),			
					producto: self.currentProduct.id,
					costo: self.$costo.val(),
					cantidad: self.$cantidad.val(),
				};
				
				datos.proveedor= self.$proveedor.val();
				datos.factura= self.$factura.val();
				datos.fecha= self.$fecha.val();
				datos.concepto= self.$concepto.val();

				if ( !self.isValid( datos ) ) {

					alert('Por favor verifica que has llenado todos los campos.');
					return;

				}

				$.post( self.prefix + '/entradas/api/agregar', datos)
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

			// when click on calcular flete
			self.$calcularFlete.on('click', function ( evt ) {

				evt.preventDefault();

				var datos = {
					'codigo': self.$codigo.val(),
					'flete': self.$flete.val(),
					'total': self.total
				};

				$.post( self.prefix + '/entradas/api/flete', datos)
				.done(function(data) {

					if (data.status == 'ok') {

						self.fleteCalculado = true;

						self.calcularDatosDeCompra();

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

				$list.parent().find('input').val(nombre);

				if ( $list.attr('id') == 'userList' ) {

					var nit = $item.attr('data-nit');

					$('#ruc').val(nit);

					self.currentClient = { 'id': id, 'nombre': nombre, 'nit': nit };
				}

				if ( $list.attr('id') == 'productList' ) {

					var costo = $item.attr('data-costo');

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
			
			this.detallesEntrada.push( producto );

			this.calcularDatosDeCompra();
		},

		eliminarDetalle: function ( codigo ) {

			for (var i = 0; i < this.detallesEntrada.length; i++) {

				if ( this.detallesEntrada[i].codigo == codigo ) {

					this.detallesEntrada.splice( i, 1 );

					this.calcularDatosDeCompra();

					return;
				}				
			}
		},

		calcularDatosDeCompra: function () {

			var total = 0,
					subtotal = 0,
					iva = 0;

			$.each( this.detallesEntrada, function( index, producto ) {

				subtotal += producto.subtotal;
				iva += producto.iva;
				total += producto.total;
			});

			this.total = total;
			this.iva = iva;
			this.subtotal = subtotal;

			this.mostrarDatosDeCompra();
		},

		mostrarDatosDeCompra: function () {

			this.$subtotal.html(this.subtotal);
			this.$iva.html(this.iva);
			this.$total.html(this.total);

			$('#Eiva').val(this.iva);
			$('#Esubtotal').val(this.subtotal);
			$('#Etotal').val(this.total);

			if ( this.fleteCalculado ) {
				var FTotal = parseFloat(this.total) + parseFloat(this.$flete.val());
				this.$totalConFlete.html( FTotal );
			}

			$('#table').bootstrapTable('refresh', {silent: true});
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

					itemHtml = '<div class="list-item" data-id="' + item.id + '" data-nombre="' + item.nombre + '" data-nit="' + item.nit + '">' +
												'<div class="w_10 list-data index">' + item.id + '</div>' +
												'<div class="w_80 list-data data">' + item.nombre + '</div>' +
											'</div>';

				} else if( type == 'producto' ) {

					itemHtml = '<div class="list-item" data-id="' + item.id + '" data-nombre="' + item.nombre + '" data-costo="' + item.costo + '">' +
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

		isValid: function ( datos ) {

			if ( datos.codigo === '' || datos.concepto === null ||
					 datos.proveedor === null || datos.producto === undefined ||
					 datos.costo === '' || datos.costo < 1 ||
					 datos.canidad < 1 || datos.cantidad === '') {

				return false;
			}

			return true;
		}
	};

	window.Entradas = Entradas;
	window.Entradas.init();
	
})(); 