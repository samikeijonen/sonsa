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