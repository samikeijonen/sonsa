<?php
/**
 * Add placeholders for comment forms.
 *
 * @package Sonsa
 */

/**
 * Add placeholders for comment form.
 *
 * @since 1.0.0
 */
function sonsa_comment_form_fields( $fields ) {
	
	// Required field.
	$req = get_option( 'require_name_email' );
	
	// Add placeholder for name.
	$fields['author'] = str_replace(
		'<input',
		'<input placeholder="'
			. esc_html_x(
				'Name',
				'comment form placeholder for name',
				'sonsa'
				)
			. ( $req ? ' *' : '' ) . '"',
		$fields['author']
	);
	
	// Add placeholder for email.
	$fields['email'] = str_replace(
		'<input',
		'<input placeholder="'
			. esc_html_x(
				'Email',
				'comment form placeholder for email',
				'sonsa'
				)
			. ( $req ? ' *' : '' ) . '"',
		$fields['email']
	);
	
	// Add placeholder for url.
	$fields['url'] = str_replace(
		'<input',
		'<input placeholder="'
			. esc_html_x(
				'Website',
				'comment form placeholder for website',
				'sonsa'
				)
			. '"',
		$fields['url']
	);
	
	// Add screen reader class for labels.
	$fields['author'] = str_replace(
		'<label',
		'<label class="screen-reader-text"',
		$fields['author']
	);
	
	$fields['email'] = str_replace(
		'<label',
		'<label class="screen-reader-text"',
		$fields['email']
	);
	$fields['url'] = str_replace(
		'<label',
		'<label class="screen-reader-text"',
		$fields['url']
	);
 
	return $fields;
	
}
add_filter( 'comment_form_default_fields', 'sonsa_comment_form_fields' );

/**
 * Add placeholder for comment form textarea field.
 *
 * @since 1.0.0
 */
function sonsa_comment_form_textarea( $fields ) {
	// Add placeholder for textarea.
	$fields['comment_field'] = str_replace(
		'<textarea',
		'<textarea placeholder="'
			. esc_html_x(
				'Comment',
				'comment form placeholder for comment field. It is noun.',
				'sonsa'
				)
			. '"',
		$fields['comment_field']
	);
	
	// Add screen reader class for comment field.
	$fields['comment_field'] = str_replace(
		'<label',
		'<label class="screen-reader-text"',
		$fields['comment_field']
	);
	return $fields;
}
add_filter( 'comment_form_defaults', 'sonsa_comment_form_textarea' );