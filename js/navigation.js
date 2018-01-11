( function( $ ) {

	( function() {

		var checkbox = $( '#mobile-menu-open' );
		var mobileMenu = checkbox.find( '~ .mobile-menu' );
		var menuToggle = $( '#navbar .btn-site-menu-toggle' );

		var toggleCheck = function() {
			checkbox.prop( 'checked', ! checkbox.prop( 'checked' ) );
			$( 'body' ).toggleClass("mm-open");

			if ( flatpressNav.menuType == 'dropdown' ) {
				mobileMenu.slideToggle( 150 );
			}
		}

		menuToggle.on( 'click', toggleCheck );

	} ) ();

} ) ( jQuery );