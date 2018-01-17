<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FlatPress
 */

?>


<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'flatpress' ); ?></a>

	<nav id="main-navigation-mobile" class="site-navigation<?php esc_attr_e( ' ' . get_theme_mod( 'menu_type', 'off_canvas' ) ); ?><?php esc_attr_e( ' ' . get_theme_mod( 'sub_menu_transition', 'submenu_slide' ) ); ?>" aria-label="Main Navigation">
		<label id="mobile-menu-label" for="mobile-menu-open" class="screen-reader-text">Toggle the main site navigation</label>
		<input id="mobile-menu-open" type="checkbox" arialabelledby="mobile-menu-label" />
		<div class="mobile-menu">
			<?php wp_nav_menu( array(
				'theme_location' => 'main-navigation',
				'container'		 => 'false',
				'menu_id'        => 'main-navigation-mobile-menu',
				'menu_class'	 => 'nav-menu',
			) );
			?>
		</div><!-- .mobile-menu -->
	</nav><!-- #main-navigation-mobile -->

	<section id="navbar">
		<div class="container">
			<div class="row no-gutters align-items-center justify-content-between">
				<header class="site-branding">
					<?php if ( flatpress_logo() && ! get_theme_mod( 'use_text_logo' ) ) : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home" tabindex="1">
							<img src="<?php echo esc_url( flatpress_get_logo() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
						</a>
					<?php else : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" tabindex="1">
							<?php if ( get_theme_mod( 'use_text_logo' ) ) : ?>
								<span class="part-one"><?php esc_html_e( get_theme_mod( 'text_logo_one' ) ); ?></span><span class="part-two"><?php esc_html_e( get_theme_mod( 'text_logo_two' ) ); ?></span>
							<?php else : ?>
								<?php esc_html_e( bloginfo( 'name' ) ); ?>
							<?php endif; ?>
						</a></h1>
					<?php endif; ?>
				</header><!-- .site-branding -->
				<div class="site-menu">
					<label for="mobile-menu-open">
						<button type="button" class="btn btn-site-menu-toggle" aria-controls="main-navigation-mobile-menu" aria-expanded="false" tabindex="2">
							<span class="icon icon-menu"></span>
							<span><?php esc_html_e( 'Menu', 'flatpress' ); ?></span>
						</button>
					</label>
				</div><!-- .site-menu -->
			</div><!-- .row -->
		</div><!-- .container -->
	</section><!-- #navbar -->

	<div id="content" class="site-content">
