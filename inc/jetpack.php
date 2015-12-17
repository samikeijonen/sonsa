<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Sonsa
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function sonsa_jetpack_setup() {
	
	// Add theme support for infinite scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'      => 'click',
		'container' => 'main',
		'render'    => 'sonsa_infinite_scroll_render',
		'footer'    => 'content',
	) );
	
	// Add theme support for portfolio.
	add_theme_support( 'jetpack-portfolio' );
	
	// Add theme support for site logo.
	add_theme_support( 'site-logo', array(
		'size' => 'sonsa-site-logo',
	) );
	
	// Add theme support for responsive videos.
	add_theme_support( 'jetpack-responsive-videos' );
	
	// Add theme support for Jetpack food menus.
	add_theme_support( 'nova_menu_item' );
	
} // end function sonsa_jetpack_setup
add_action( 'after_setup_theme', 'sonsa_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function sonsa_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function sonsa_infinite_scroll_render
