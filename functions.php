<?php
/**
 * FlatPress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FlatPress
 */

if ( ! function_exists( 'flatpress_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function flatpress_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on FlatPress, use a find and replace
		 * to change 'flatpress' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'flatpress', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-navigation' => esc_html__( 'Main Navigation', 'flatpress' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'flatpress_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'flatpress_setup' );

/**
 * Google fonts
 */
function flatpress_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Poppins, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$font_families = array();

	$poppins = _x( 'on', 'Poppins font: on or off', 'flatpress' );

	if ( 'off' !== $poppins ) {
		$font_families[] = 'Poppins:400,600';
	}

	if ( in_array( 'on', array( $poppins ) ) ) {
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

function flatpress_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'flatpress-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'flatpress_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function flatpress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'flatpress_content_width', 640 );
}
add_action( 'after_setup_theme', 'flatpress_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function flatpress_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'flatpress' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'flatpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'flatpress_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function flatpress_scripts() {
	wp_enqueue_style( 'flatpress-fonts', flatpress_fonts_url(), array(), null );

	wp_enqueue_style( 'flatpress-style', get_stylesheet_uri() );

	wp_enqueue_script( 'flatpress-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '1.0', true );

	wp_localize_script( 'flatpress-navigation', 'flatpressNav', array(
		'menuType'				=> get_theme_mod( 'menu_type', 'off_canvas' ),
		'subMenuHeaderType'		=> get_theme_mod( 'sub_menu_header_type', 'in_menu' ),
		'subMenuTransition'	=> get_theme_mod( 'sub_menu_transition', 'submenu_slide' ),
		'backBtn'				=> __( 'Menu', 'flatpress' ),
		'expand'				=> __( 'Expand child menu', 'flatpress' ),
		'collapse'				=> __( 'Collapse child menu', 'flatpress' ),
	) );

	wp_enqueue_script( 'flatpress-scripts', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'flatpress_scripts' );

/**
 * Check for custom logo.
 *
 * @return boolean
 */
function flatpress_logo() {
	return get_theme_mod( 'logo_img' ) ? true : false;
}

/**
 * Get custom logo url.
 *
 * @return string
 */
function flatpress_get_logo() {
	return get_theme_mod( 'logo_img' );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * tfcustomizer
 */
require get_template_directory() . '/inc/class-tfcustomizer-control.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
