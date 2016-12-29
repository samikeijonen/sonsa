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
<head <?php hybrid_attr( 'head' ); ?>>
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
	
			<?php 
				if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'sidebar-1' ) || has_nav_menu( 'social' ) ) :
					// Extra class for checking there is only header or social menu active.
					$extra_class = ( ! has_nav_menu( 'primary' ) && ! is_active_sidebar( 'sidebar-1' ) && has_nav_menu( 'social' ) ) ? ' header-social-links-only' : ''; ?>
					<button id="sidebar-nav-toggle" class="sidebar-nav-toggle sidebar-nav-open button-toggle<?php echo $extra_class; ?>"><span class="screen-reader-text"><?php esc_html_e( 'Expand sidebar', 'sonsa' ); ?></span></button>
			<?php 
				endif;
			?>
			
			<div class="wrap">
			
				<?php if ( function_exists( 'the_custom_logo' ) ) the_custom_logo(); ?>
		
				<div id="site-branding" class="site-branding">
			
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title" <?php hybrid_attr( 'site-title' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title" <?php hybrid_attr( 'site-title' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;
					
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description" <?php hybrid_attr( 'site-description' ); ?>><?php echo $description; ?></p>
					<?php endif; ?>
					
					<?php if ( is_active_sidebar( 'header' ) || has_nav_menu( 'social' ) ) : ?>
										
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
		
			<!-- Preloader -->
			<div id="preloader" class="preloader">
				<div id="status" class="status">
					<span class="screen-reader-text"><?php esc_html_e( 'Site is loading', 'sonsa' ); ?></span>
					<div class="sk-three-bounce">
						<div class="sk-child sk-bounce1"></div>
						<div class="sk-child sk-bounce2"></div>
						<div class="sk-child sk-bounce3"></div>
					</div>
				</div>
			</div>
		
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main" <?php hybrid_attr( 'content' ); ?>>
