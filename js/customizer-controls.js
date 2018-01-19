( function ( $ ) {

	wp.customize.bind( 'ready', function() {

		var tfcustomizerOptions = {
			controls: {
				/*txtLogo : {
					name: 'use_text_logo',
					toggle: {
						'true': [ 'text_logo_one', 'text_logo_two' ],
						'false': [ 'logo_img' ]
					}
				},*/
				subMenuTransition : {
					name: 'sub_menu_transition',
					toggle: {
						'submenu_slide': [ 'sub_menu_header_type' ]
					}
				}
			}
		};

		var controls = $( '#customize-theme-controls input[data-customize="tfcustomizer"]' );

		controls.tfcustomizer( this, tfcustomizerOptions );

	} );

} ) ( jQuery );