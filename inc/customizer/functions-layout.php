<?php
/**
 * Theme Customizer for layout.
 *
 * @package Sonsa
 */
 
// Add the layout section.
$wp_customize->add_section(
	'sonsa-layout',
	array(
		'title'    => esc_html__( 'Layouts', 'sonsa' ),
		'priority' => 10,
		'panel'    => 'theme'
	)
);

// Add the layout setting.
$wp_customize->add_setting(
	'theme_layout',
	array(
		'default'           => 'header-left',
		'sanitize_callback' => 'sonsa_sanitize_layout'
	)
);
	
$layout_choices = array( 
	'header-left' => esc_html__( 'Header on the left', 'sonsa' ),
	'header-top'  => esc_html__( 'Header on the top', 'sonsa' ),
);
	
/* Add the layout control. */
$wp_customize->add_control(
	'theme_layout',
	array(
		'label'    => esc_html__( 'Global Layout', 'sonsa' ),
		'section'  => 'sonsa-layout',
		'priority' => 10,
		'type'     => 'radio',
		'choices'  => $layout_choices
	)
);