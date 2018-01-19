( function( $ ) {

	$.fn.tfcustomizer = function( customizer, options ) {

		this.on( 'change', dispatch );
		dispatch();

		function dispatch( e ) {

			var initSrc = 'init';

			if ( e && e.type === 'change' ) {

				initSrc = 'event'
				var _this = $( this );
			
			}

			$.each( options.controls, function( o, c ) {

				if ( initSrc === 'event' || typeof _this !== 'undefined' ) {

					if ( _this.data( 'name' ) !== c.name ) {

						return;

					}

				}

				assemble( c, initSrc );
				return initSrc == 'init' ? true : false;

			} );

		}

		function assemble( control, initSrc ) {

			var c = customizer.instance( control.name ).get().toString();
			var show = control.toggle[ c ];

			if ( show === undefined || Object.keys( control.toggle ).length == 1 ) {

				var toggler = Object.values( control.toggle );
				var selector = createSelector( toggler );

				if ( initSrc != 'init' ) {
					$( selector ).toggle();
				}

			} else {

				var hide = [];

				$.each( control.toggle, function( k, v ) { if ( k === c ) { return; } hide.push( v ); } );

				var showSelector = createSelector( show );
				var hideSelector = createSelector( hide );

				$( showSelector ).show();
				$( hideSelector ).hide();

			}

		};

		function createSelector( obj ) {

			obj = ( obj[ 0 ].constructor === Array ) ? obj[ 0 ] : obj;

			var prefix = '#customize-control-';
			var obj = $( obj ).map( function() { return prefix + this; } ).get().join();

			return obj;

		};

	};

} ) ( jQuery );