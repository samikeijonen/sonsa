<?php
/**
 * Implementation of the Custom Header feature.
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package Sonsa
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses sonsa_header_style()
 */
function sonsa_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'sonsa_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1200,
		'height'                 => 1200,
		'flex-height'            => true,
		'flex-width'             => true,
		'wp-head-callback'       => 'sonsa_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'sonsa_custom_header_setup', 15 );

if ( ! function_exists( 'sonsa_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see sonsa_custom_header_setup().
 */
function sonsa_header_style() {
	
	// Header text color.
	$header_color = get_header_textcolor();
	
	// Header image.
	$header_image = esc_url( get_header_image() );
	
	// Start header styles.
	$style = '';
	
	// Header image height.
	$header_height = get_custom_header()->height;
	
	// Header image width.
	$header_width = get_custom_header()->width;
	
	// When to show header image.
	$min_width = absint( apply_filters( 'sonsa_header_bg_show', 960 ) );
	
	if ( ! empty( $header_image ) ) {
		$style .= "@media screen and (min-width: {$min_width}px) { 
			body.custom-header-image .site-header {
				background-image: url({$header_image});
				background-repeat: no-repeat;
				background-position: center bottom;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}
		}";
	}
	
	/* Site title styles. */
	if ( display_header_text() ) {
		$style .= ".site-title, .site-title a, .site-description { color: #{$header_color} }";
		$style .= ".site-title a { border-color: #{$header_color} }";
	}
	
	if ( ! display_header_text() ) {
		$style .= ".site-title, .site-title a, .site-description { clip: rect(1px, 1px, 1px, 1px); position: absolute; }";	
	}
	
	/* Echo styles if it's not empty. */
	if ( ! empty( $style ) ) {
		echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
	}

}
endif; // sonsa_header_style