<?php
/**
 * Sonsa Theme Customizer.
 *
 * @package Sonsa
 */
 
/**
 * Add the Customizer functionality.
 *
 * @since 1.0.0
 */
function sonsa_customize_register( $wp_customize ) {

	// Add the theme panel.
	$wp_customize->add_panel(
		'theme',
		array(
			'title'    => esc_html__( 'Theme Settings', 'sonsa' ),
			'priority' => 10
		)
	);
	
	// Load different part of the Customizer.
	require_once( get_template_directory() . '/inc/customizer/functions-layout.php' );
	
	if( class_exists( 'WP_Customize_Cropped_Image_Control' ) ) {
		require_once( get_template_directory() . '/inc/customizer/functions-default-image.php' );
		require_once( get_template_directory() . '/inc/customizer/functions-404.php' );
	}
	
}
add_action( 'customize_register', 'sonsa_customize_register' );

/**
 * Sanitize the Global layout value.
 *
 * @since 1.0.0
 *
 * @param string $layout Layout type.
 * @return string Filtered layout type (header-left|header-top).
 */
function sonsa_sanitize_layout( $layout ) {

	if ( ! in_array( $layout, array( 'header-left', 'header-top' ) ) ) {
		$layout = 'header-left';
	}

	return $layout;
	
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sonsa_customize_register_pm( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'sonsa_customize_register_pm' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sonsa_customize_preview_js() {
	wp_enqueue_script( 'sonsa_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20150508', true );
}
add_action( 'customize_preview_init', 'sonsa_customize_preview_js' );
