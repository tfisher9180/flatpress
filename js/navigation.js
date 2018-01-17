( function( $ ) {

	var navigation = $( '#main-navigation-mobile-menu' );

	( function() {

		var hasChildren = navigation.find( '.menu-item-has-children, .page_item_has_children' );

		if ( ! navigation.length || ! hasChildren.length ) {
			return;
		}

		var subMenus = hasChildren.find( '> .sub-menu' );
		var submenuToggle = $( '<button />', { 'class': 'btn submenu-toggle', 'aria-expanded': false } )
			.append( $( '<span />', { 'class': 'screen-reader-text', text: flatpressNav.expand } ) )
			.append( $( '<span />', { 'class': 'icon icon-angle-right' } ) );
		var toggleSubmenu = function( e ) {
			if ( $( this ).is( 'a' ) ) {
				e.preventDefault();
			}
			var _this = $( this );
			var activeLi = _this.closest( 'li:not(.go-back)' );
			var activeUl = activeLi.closest( 'ul' );
			var subMenu = activeLi.find( '> .sub-menu' );
			var submenuToggle = activeLi.find( '> .submenu-toggle' );

			activeLi.toggleClass( 'sub-menu-active' );

			if ( flatpressNav.subMenuTransition == 'submenu_slide' ) {
				activeUl.toggleClass( 'move-out' );
			} else if ( flatpressNav.subMenuTransition == 'submenu_dropdown' ) {
				subMenu.slideToggle( 300 );
			}

			subMenu.add( submenuToggle ).attr( 'aria-expanded', activeLi.hasClass( 'sub-menu-active' ) );
		};

		navigation.add( subMenus ).attr( 'aria-expanded', false );

		if ( flatpressNav.subMenuHeaderType == 'in_menu' && flatpressNav.subMenuTransition == 'submenu_slide' ) {
			var goBack = $( '<li />', { 'class': 'go-back menu-item', 'aria-hidden': true } )
				.append( $( '<a />', { 'href': '#' } )
					.append( $( '<span />', { text: flatpressNav.backBtn } ) ) );
			subMenus.prepend( goBack );
			subMenus.find( '.go-back > a' ).on( 'click', toggleSubmenu );
		}

		hasChildren.find( '> a' ).after( submenuToggle );
		var toggles = navigation.find( '.submenu-toggle' );

		if ( ! toggles.length ) {
			return;
		}

		toggles.on( 'click', toggleSubmenu );

	} ) ();

	( function() {

		var checkbox = $( '#mobile-menu-open' );
		var mobileMenu = checkbox.find( '~ .mobile-menu' );
		var menuToggle = $( '#navbar .btn-site-menu-toggle' );

		var toggleCheck = function() {
			checkbox.prop( 'checked', ! checkbox.prop( 'checked' ) );
			$( 'body' ).toggleClass( 'mm-open' );
			menuToggle.add( navigation ).attr( 'aria-expanded', $( 'body' ).hasClass( 'mm-open' ) );

			if ( flatpressNav.menuType == 'dropdown' ) {
				mobileMenu.slideToggle( 150 );
			}
		}

		menuToggle.on( 'click', toggleCheck );

	} ) ();

} ) ( jQuery );
