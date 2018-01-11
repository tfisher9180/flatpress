( function ( $ ) {

	wp.customize.bind( 'ready', function() {

		function toggleLogoControls() {
			var textLogoIds = [ 'text_logo_one', 'text_logo_two' ];
			var logoImgIds = [ 'logo_img' ];

			if ( wp.customize.instance( 'use_text_logo' ).get() == true ) {
				$.each( textLogoIds, function( i, value ) {
					$( '#customize-control-' + value ).show();
				} );
				$.each( logoImgIds, function( i, value ) {
					$( '#customize-control-' + value ).hide();
				} );
			} else {
				$.each( textLogoIds, function( i, value ) {
					$( '#customize-control-' + value ).hide();
				} );
				$.each( logoImgIds, function( i, value ) {
					$( '#customize-control-' + value ).show();
				} );
			}
		}

		// call function on page load
		toggleLogoControls();

		// call function on change
		$( '#customize-control-use_text_logo' ).on( 'change', toggleLogoControls );

	} );

} ) ( jQuery );