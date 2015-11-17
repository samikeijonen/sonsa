<?php
/**
 * Custom background feature
 *
 * @package Sonsa
 */

/**
 * Adds support for the WordPress 'custom-background' theme feature.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function sonsa_custom_background_setup() {

	add_theme_support( 'custom-background',
		apply_filters( 'sonsa_custom_background_args',
			array(
				'default-color'    => 'ffffff',
				'default-image'    => '',
			) 
		)
	);
}
add_action( 'after_setup_theme', 'sonsa_custom_background_setup', 15 );
