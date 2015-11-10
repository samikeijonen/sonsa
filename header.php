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
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php hybrid_attr( 'body' ); ?>>
<div id="page" class="site">
	<div id="site-wrapper" class="site-wrapper">
		
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'sonsa' ); ?></a>

		<header id="masthead" class="site-header" role="banner" <?php hybrid_attr( 'header' ); ?>>
	
			<?php if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'primary' ) ) : ?>
				<button id="sidebar-nav-toggle" class="sidebar-nav-toggle sidebar-nav-open button-toggle"><span class="screen-reader-text"><?php esc_html_e( 'Expand sidebar', 'sonsa' ); ?></span></button>
			<?php endif; ?>
		
			<div class="wrap">
			
				<?php if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>
		
				<div id="site-branding" class="site-branding">
			
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title" <?php hybrid_attr( 'site-title' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title" <?php hybrid_attr( 'site-title' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
					<p class="site-description" <?php hybrid_attr( 'site-description' ); ?>><?php bloginfo( 'description' ); ?></p>
			
					<?php if ( is_active_sidebar( 'header' ) || has_nav_menu( 'social' ) ) : ?>
							
						<button id="header-social-button" class="header-social-button header-social-toggle button-toggle"><span class="screen-reader-text"><?php esc_html_e( 'Toggle Header', 'sonsa' ); ?></span></button>	
						
						<div id="header-social-wrap" class="header-social-wrap">
						
							<div class="wrap">
						
								<?php get_sidebar( 'header' ); // Loads the sidebar-header.php template. ?>
								<?php get_template_part( 'menu', 'social' ); // Loads the menu-social.php template. ?>
							
							</div><!-- .wrap -->
							
						</div><!-- .header-social-wrap -->
						
					<?php endif; ?>
				
				</div><!-- .site-branding -->
			
			</div><!-- .wrap -->
		</header><!-- #masthead -->

		<div id="content" class="site-content">
		
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main" <?php hybrid_attr( 'content' ); ?>>
