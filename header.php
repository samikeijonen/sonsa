<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sonsa
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
<div id="page" class="hfeed site">
	<div class="site-wrapper">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'sonsa' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
	
			<?php // if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'primary' ) ) : ?>
				<button id="sidebar-nav-toggle" class="sidebar-nav-toggle"><span class="genericon genericon-menu"></span><span class="screen-reader-text"><?php _e( 'Toggle Menu', 'toivo' ); ?></span></button>
			<?php // endif; ?>
		
			<div class="wrap">
			
				<?php if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>
		
				<div class="site-branding">
			
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			
					<?php get_sidebar( 'header' ); // Loads the sidebar-header.php template. ?>
				
					<?php get_template_part( 'menu', 'social' );    // Loads the menu-social.php template. ?>
				
				</div><!-- .site-branding -->
			
			</div><!-- .wrap -->
		</header><!-- #masthead -->

		<div id="content" class="site-content">
