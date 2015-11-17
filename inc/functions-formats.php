<?php
/**
 * Functions and filters for handling the output of post formats. This file is only loaded if
 * themes declare support for `post-formats`.
 *
 * Most of the functions are from Justin Tadlock's Hybrid Core Framework.
 *
 * @package    Sonsa
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2008 - 2015, Justin Tadlock
 * @link       http://themehybrid.com/hybrid-core
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Theme compatibility for post formats. This function adds appropriate filters to 'the_content' for
 * the various post formats that a theme supports.
 *
 * @since  1.6.0
 * @access public
 * @return void
 */
function sonsa_structured_post_formats() {

	// Filter the content of chat posts.
	if ( current_theme_supports( 'post-formats', 'chat' ) ) {
		add_filter( 'the_content', 'sonsa_chat_content', 9 ); // run before wpautop
	}
	
}
add_action( 'wp_loaded', 'sonsa_structured_post_formats', 0 );

/**
 * This function filters the post content when viewing a post with the "chat" post format.
 *
 * @since  1.6.0
 * @access public
 * @param  string  $content
 * @return string
 */
function sonsa_chat_content( $content ) {
	return has_post_format( 'chat' ) && ! post_password_required() ? sonsa_get_chat_transcript( $content ) : $content;
}

/**
 * Gets a chat transcript.
 *
 * @since  3.0.0
 * @access public
 * @param  string  $content
 * @return string
 */
function sonsa_get_chat_transcript( $content ) {
	$chat = new Hybrid_Chat( $content );

	return $chat->get_transcript();
}

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @copyright Twenty Thirteen Theme
 * @since 1.0.0
 *
 * @return string The Link format URL.
 */
function sonsa_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}