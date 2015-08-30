<?php
/**
 * Theme Customizer for default post image.
 *
 * @package Sonsa
 */

	/* == Default post image section == */
	
	/* Add the default post image section. */
	$wp_customize->add_section(
		'default-post-image',
		array(
			'title'    => esc_html__( 'Default post image', 'sonsa' ),
			'priority' => 10,
			'panel'    => 'theme'
		)
	);

	/* Add the default post image setting. */
	$wp_customize->add_setting(
		'default_post_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'absint'
		)
	);
	
	/* Add the default post image control. */
	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
		$wp_customize,
			'default_post_image',
				array(
					'label'       => esc_html__( 'Default post image', 'sonsa' ),
					'description' => esc_html__( 'Add image which is displayed on post where you have not set featured image. It will be used home and archive pages. Recommended width is 960px.', 'sonsa' ),
					'section'     => 'default-post-image',
					'priority'    => 10,
					'flex_width'  => true,
					'flex_height' => true,
					'width'       => 960,
					'height'      => 540,
				)
		)
	);