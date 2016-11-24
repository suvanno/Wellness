<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wellness
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wellness' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container">

			<div class="site-branding">

				<?php
				if ( function_exists( 'the_custom_logo' ) ) {
					the_custom_logo();
				}
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;
				?>
			</div><!-- .site-branding -->

			<div class="header-search">
				<button class="search-toggle fa fa-search" aria-expanded="false"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'wellness' ); ?></span></button>
				<?php get_search_form( true ); ?>
			</div>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<div class="menu-toggle-wrapper">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'wellness' ); ?></button>
				</div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->



		</div><!-- .container -->
	</header><!-- #masthead -->
	<?php if ( get_header_image() ) : ?>
	<div id="header-image">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</div>
	<?php endif;?>

	<div id="content" class="site-content">
		<div class="container">
