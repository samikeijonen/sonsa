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

	// Wraps `<blockquote>` around quote posts.
	if ( current_theme_supports( 'post-formats', 'quote' ) ) {
		add_filter( 'the_content', 'sonsa_quote_content' );
	}

	// Filter the content of chat posts.
	if ( current_theme_supports( 'post-formats', 'chat' ) ) {
		add_filter( 'the_content', 'sonsa_chat_content', 9 ); // run before wpautop
	}
	
}
add_action( 'wp_loaded', 'sonsa_structured_post_formats', 0 );

/* === Links === */

/**
 * Filters the content of the link format posts. Wraps the content in the `make_clickable()` function
 * so that users can enter just a URL into the post content editor.
 *
 * @since  1.6.0
 * @access public
 * @param  string $content
 * @return string
 */
function sonsa_link_content( $content ) {

	if ( has_post_format( 'link' ) && ! post_password_required() && ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', $content ) ) {
		$content = make_clickable( $content );
	}

	return $content;
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

/* === Quotes === */

/**
 * Checks if the quote post has a <blockquote> tag within the content.  If not, wraps the entire post
 * content with one.
 *
 * @since  1.6.0
 * @access public
 * @param  string $content
 * @return string
 */
function sonsa_quote_content( $content ) {

	if ( has_post_format( 'quote' ) && ! post_password_required() ) {
		preg_match( '/<blockquote.*?>/', $content, $matches );

		if ( empty( $matches ) )
			$content = "<blockquote>{$content}</blockquote>";
	}

	return $content;
	
}

/* === Chats === */

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