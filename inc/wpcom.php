<?php
/**
 * WordPress.com-specific functions and definitions.
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package Sonsa
 */

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @since  1.0.0
 * @global array $themecolors
 */
function sonsa_wpcom_setup() {
	
	global $themecolors;

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {
		$themecolors = array(
			'bg'     => 'ffffff',
			'border' => 'e5e5e5',
			'text'   => '444444',
			'link'   => '000000',
			'url'    => '000000',
		);
	}
}
add_action( 'after_setup_theme', 'sonsa_wpcom_setup' );

/**
 * De-queue Google fonts if custom fonts are being used instead.
 *
 * @since 1.0.0
 */
function sonsa_dequeue_fonts() {
	
	if ( class_exists( 'TypekitData' ) && class_exists( 'CustomDesign' ) && CustomDesign::is_upgrade_active() ) {
		
		$custom_fonts = TypekitData::get( 'families' );
			
		if ( $custom_fonts && $custom_fonts['headings']['id'] && $custom_fonts['body-text']['id'] ) {
			wp_dequeue_style( 'sonsa-fonts' );
		}
		
	}
	
}
add_action( 'wp_enqueue_scripts', 'sonsa_dequeue_fonts' );

/**
 * Enqueue WordPress.com-specific styles.
 *
 * @since 1.0.0
 */
function sonsa_wpcom_styles() {
	wp_enqueue_style( 'sonsa-wpcom', get_template_directory_uri() . '/inc/style-wpcom.css', '20160105' );
}
add_action( 'wp_enqueue_scripts', 'sonsa_wpcom_styles' );