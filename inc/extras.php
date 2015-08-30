<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Sonsa
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function sonsa_body_classes( $classes ) {
	
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	// Adds a class to 404 page if there is image set in the Customizer.
	if ( is_404() && get_theme_mod( '404_image' ) ) {
		$classes[] = 'has-404-image';
	}

	return $classes;
	
}
add_filter( 'body_class', 'sonsa_body_classes' );
