<?php
/**
 * Filters archive title and description.
 *
 * @package Sonsa
 */

/**
 * Filters `get_the_archve_title` to add better archive titles than core.
 *
 * @since  1.0.0
 *
 * @param  string  $title
 * @return string
 */
function sonsa_archive_title_filter( $title ) {

	if ( is_home() && ! is_front_page() ) {
		$title = get_post_field( 'post_title', get_queried_object_id() );
	}

	elseif ( is_category() ) {
		$title = single_cat_title( '', false );
	}

	elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	}

	elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	elseif ( is_author() ) {
		$title = get_the_author_meta( 'display_name', absint( get_query_var( 'author' ) ) );
	}
	
	elseif ( is_search() ) {
		$title = sprintf( esc_html__( 'Search results for &#8220;%s&#8221;', 'sonsa' ), get_search_query() );
	}

	elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}

	elseif ( is_month() ) {
		$title = single_month_title( ' ', false );
	}

	return apply_filters( 'sonsa_archive_title', $title );
}
add_filter( 'get_the_archive_title', 'sonsa_archive_title_filter', 5 );

/**
 * Filters `get_the_archve_description` to add better archive descriptions than core.
 *
 * @since  1.0.0
 *
 * @param  string  $desc
 * @return string
 */
function sonsa_archive_description_filter( $desc ) {

	if ( is_home() && ! is_front_page() ) {
		$desc = get_post_field( 'post_content', get_queried_object_id(), 'raw' );
	}
	
	elseif ( is_author() ) {
		$desc = get_the_author_meta( 'description', get_query_var( 'author' ) );
	}

	return apply_filters( 'sonsa_archive_description', $desc );
}
add_filter( 'get_the_archive_description', 'sonsa_archive_description_filter', 5 );