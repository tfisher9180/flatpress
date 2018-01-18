<?php
/**
 * FlatPress Theme Customizer
 *
 * @package FlatPress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function flatpress_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->remove_control( 'custom_logo' );
	$wp_customize->remove_control( 'display_header_text' );

	$wp_customize->add_panel( 'theme_options', array(
		'priority'				=> 10,
		'capability'			=> 'edit_theme_options',
		'title'						=> __( 'Theme Options', 'flatpress' ),
		'description'			=> __( 'Custom options for the theme.', 'flatpress' ),
	));

	$wp_customize->add_section( 'theme_options_logo', array(
		'capability'			=> 'edit_theme_options',
		'title'						=> __( 'Logo', 'flatpress' ),
		'description'			=> __( 'Logo for the FlatPress theme.', 'flatpress' ),
		'panel'						=> 'theme_options',
	));

	$wp_customize->add_section( 'theme_options_menu', array(
		'capability'			=> 'edit_theme_options',
		'title'						=> __( 'Menu', 'flatpress' ),
		'description'			=> __( 'Menu options for the FlatPress theme.', 'flatpress' ),
		'panel'						=> 'theme_options',
	));

	$wp_customize->add_setting( 'logo_img' );

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize, 'logo_img', array(
			'priority'			=> 20,
			'label'					=> __( 'Logo', 'flatpress' ),
			'description'		=> __( 'Recommended logo dimensions: 150x35', 'flatpress' ),
			'section'				=> 'theme_options_logo',
			'settings'			=> 'logo_img',
	) ) );

	$wp_customize->add_setting( 'text_logo_one', array(
		'type'					=> 'theme_mod',
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'text_logo_one', array(
		'priority'				=> 20,
		'type'					=> 'text',
		'label'					=> __( 'Text Logo Part 1', 'flatpress' ),
		'section'				=> 'theme_options_logo',
	) );

	$wp_customize->add_setting( 'text_logo_two', array(
		'type'					=> 'theme_mod',
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'text_logo_two', array(
		'priority'				=> 30,
		'type'					=> 'text',
		'label'					=> __( 'Text Logo Part 2', 'flatpress' ),
		'section'				=> 'theme_options_logo',
	) );

	$wp_customize->add_setting( 'use_text_logo', array(
		'type'					=> 'theme_mod',
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'flatpress_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'use_text_logo', array(
		'priority'				=> 10,
		'type'					=> 'checkbox',
		'label'					=> __( 'Use Text Logo', 'flatpress' ),
		'section'				=> 'theme_options_logo',
	) );

	$wp_customize->add_setting( 'menu_type', array(
		'default'				=> 'off_canvas',
		'type'					=> 'theme_mod',
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'flatpress_sanitize_choice',
	) );

	$wp_customize->add_control( 'menu_type', array(
		'priority'				=> 10,
		'type'					=> 'select',
		'label'					=> __( 'Menu Type', 'flatpress' ),
		'section'				=> 'theme_options_menu',
		'choices'				=> array(
			'off_canvas'	=> 'Off Canvas',
			'dropdown'		=> 'Dropdown'
		),
	) );

	$wp_customize->add_setting( 'sub_menu_transition', array(
		'default'				=> 'submenu_slide',
		'type'					=> 'theme_mod',
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'flatpress_sanitize_choice',
	) );

	$wp_customize->add_control( 'sub_menu_transition', array(
		'priority'				=> 20,
		'type'					=> 'radio',
		'label'					=> __( 'Sub-menu Transition', 'flatpress' ),
		'section'				=> 'theme_options_menu',
		'choices'				=> array(
			'submenu_slide'		=> 'Slide',
			'submenu_dropdown'		=> 'Dropdown'
		),
	) );

	$wp_customize->add_setting( 'sub_menu_header_type', array(
		'default'				=> 'in_menu',
		'type'					=> 'theme_mod',
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'flatpress_sanitize_choice',
	) );

	$wp_customize->add_control( 'sub_menu_header_type', array(
		'priority'				=> 30,
		'type'					=> 'radio',
		'label'					=> __( 'Sub-menu Header Type', 'flatpress' ),
		'section'				=> 'theme_options_menu',
		'choices'				=> array(
			'in_menu'		=> 'In-menu',
			'global'		=> 'Global'
		),
	) );

	$wp_customize->add_setting( 'test', array(
		'default'				=> 'one',
		'type'					=> 'theme_mod',
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'flatpress_sanitize_choice',
	) );

	$wp_customize->add_control( new WP_Customize_tfcustomizer_Control( $wp_customize, 'test', array(
		'priority'				=> 40,
		'type'					=> 'radio',
		'label'					=> __( 'This is a test', 'flatpress' ),
		'section'				=> 'theme_options_menu',
		'choices'				=> array(
			'one'		=> 'One',
			'two'		=> 'Two'
		),
	) ) );

	$wp_customize->add_setting( 'test_one', array(
		'default'				=> '',
		'type'					=> 'theme_mod',
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'test_one', array(
		'priority'				=> 50,
		'type'					=> 'text',
		'label'					=> __( 'Test One', 'flatpress' ),
		'section'				=> 'theme_options_menu',
	) );

	$wp_customize->add_setting( 'test_two', array(
		'default'				=> '',
		'type'					=> 'theme_mod',
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'test_two', array(
		'priority'				=> 50,
		'type'					=> 'text',
		'label'					=> __( 'Test Two', 'flatpress' ),
		'section'				=> 'theme_options_menu',
	) );

	$wp_customize->add_setting( 'test_again', array(
		'default'				=> 'three',
		'type'					=> 'theme_mod',
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'flatpress_sanitize_choice',
	) );

	$wp_customize->add_control( new WP_Customize_tfcustomizer_Control( $wp_customize, 'test_again', array(
		'priority'				=> 40,
		'type'					=> 'radio',
		'label'					=> __( 'This is a test', 'flatpress' ),
		'section'				=> 'theme_options_menu',
		'choices'				=> array(
			'three'		=> 'Three',
			'four'		=> 'Four'
		),
	) ) );

	$wp_customize->add_setting( 'test_three', array(
		'default'				=> '',
		'type'					=> 'theme_mod',
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'test_three', array(
		'priority'				=> 50,
		'type'					=> 'text',
		'label'					=> __( 'Test Three', 'flatpress' ),
		'section'				=> 'theme_options_menu',
	) );

	$wp_customize->add_setting( 'test_four', array(
		'default'				=> '',
		'type'					=> 'theme_mod',
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'		=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'test_four', array(
		'priority'				=> 50,
		'type'					=> 'text',
		'label'					=> __( 'Test Four', 'flatpress' ),
		'section'				=> 'theme_options_menu',
	) );

	

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'flatpress_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'flatpress_customize_partial_blogdescription',
		) );
	}

	function flatpress_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

	function flatpress_sanitize_choice( $input, $setting ) {
		// Ensure input is a slug (escaping illegal characters).
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid choice, return it; otherwise, return the default.
		return array_key_exists( $input, $choices ) ? $input : $setting->default;
	}
}
add_action( 'customize_register', 'flatpress_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function flatpress_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function flatpress_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Enqueue the script that controls our customizer controls.
 */
function flatpress_customizer_controls() {
	wp_enqueue_script( 'flatpress_tfcustomizer', get_template_directory_uri() . '/js/jquery.tfcustomizer.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'flatpress_customizer_controls', get_template_directory_uri() . '/js/customizer-controls.js', array( 'jquery' ), null, true );
}
add_action( 'customize_controls_enqueue_scripts', 'flatpress_customizer_controls' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function flatpress_customize_preview_js() {
	wp_enqueue_script( 'flatpress-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'flatpress_customize_preview_js' );
