( function( $ ) {

	( function() {

		var navigation = $( '#main-navigation-mobile-menu' );
		var hasChildren = navigation.find( '.menu-item-has-children, .page_item_has_children' );

		if ( ! hasChildren.length ) {
			return;
		}

		var submenuToggle = $( '<button />', { 'class': 'btn submenu-toggle', 'aria-expanded': false } )
			.append( $( '<span />', { 'class': 'screen-reader-text', text: flatpressNav.expand } ) )
			.append( $( '<span />', { 'class': 'icon icon-angle-right' } ) );

		hasChildren.find( '> a' ).after( submenuToggle );

		var toggles = navigation.find( '.submenu-toggle' );

		if ( ! toggles.length ) {
			return;
		}

		var toggleSubmenu = function() {

		}

		toggles.on( 'click', toggleSubmenu );

	} ) ();

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