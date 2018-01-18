( function ( $ ) {

	wp.customize.bind( 'ready', function() {

		var tfcustomizerOptions = [
			{
				name: 'use_text_logo',
				toggle: {
					'true': [ 'text_logo_one', 'text_logo_two' ],
					'false': [ 'logoImgIds' ]
				}
			},
			{
				name: 'test',
				toggle: {
					'one': [ 'test_one' ],
					'two': [ 'test_two' ]
				}
			},
			{
				name: 'test_again',
				toggle: {
					'three': [ 'test_three' ],
					'four': [ 'test_four' ]
				}
			}
		];

		var controls = $( '#customize-theme-controls input[data-customize="tfcustomizer"]' );

		controls.tfcustomizer( this, tfcustomizerOptions );

	} );

} ) ( jQuery );