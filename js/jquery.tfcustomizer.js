( function( $ ) {

	$.fn.tfcustomizer = function( customizer, options ) {

		function toggle() {

			for ( var ctrl in options ) {

				if ( options.hasOwnProperty( ctrl ) ) {

					var control = options[ ctrl ];

					$.each( control.toggle, function( k, v ) {

						var selector = createSelector( v );

						if ( customizer.instance( control.name ).get() == k ) {

							$( selector ).show();

						} else {

							$( selector ).hide();

						}

					} );

				}
			}
		};

		function toggleChange() {

			var _this = $( this );

			var matchedOption = $.grep( options, function( v, i ) {

				console.log( v );
				console.log( i );

			} );

			console.log( matchedOption );

		};

		function createSelector( obj ) {

			return $( obj ).map( function() {

				return '#customize-control-' + this;

			} )
			.get()
			.join();

		};

		toggle();
		this.on( 'change', toggleChange );

	};

} ) ( jQuery );