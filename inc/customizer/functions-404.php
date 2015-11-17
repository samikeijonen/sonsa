<?php
/**
 * Theme Customizer for 404 page image.
 *
 * @package Sonsa
 */
	
// Add the 404 section.
$wp_customize->add_section(
	'404',
	array(
		'title'    => esc_html__( '404 page image', 'sonsa' ),
		'priority' => 20,
		'panel'    => 'theme'
	)
);

// Add the 404 image setting.
$wp_customize->add_setting(
	'404_image',
	array(
		'default'           => '',
		'sanitize_callback' => 'absint'
	)
);
	
// Add the 404 image control.
$wp_customize->add_control(
	new WP_Customize_Cropped_Image_Control(
	$wp_customize,
		'404_image',
			array(
				'label'       => esc_html__( '404 Image', 'sonsa' ),
				'description' => esc_html__( 'Add image which is displayed on 404 page. Recommended width is 960px.', 'sonsa' ),
				'section'     => '404',
				'priority'    => 10,
				'flex_width'  => true,
				'flex_height' => true,
				'width'       => 960,
				'height'      => 540,
			)
	)
);