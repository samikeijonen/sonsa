<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Sonsa
 */

if ( ! function_exists( 'sonsa_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 1.0.0
 */
function sonsa_posted_on() {

	/* Set up entry date. */
	printf( '<span class="entry-date"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s"' . hybrid_get_attr( 'entry-published' ) . '>%4$s</time></a></span>',
		_x( 'Posted on', 'Used before publish date.', 'sonsa' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	
	/* Set up byline. */
	printf( '<span class="byline"><span class="entry-author" ' . hybrid_get_attr( 'entry-author' ) . '><span class="screen-reader-text">%1$s </span><a class="entry-author-link" href="%2$s" rel="author" itemprop="url"><span itemprop="name">%3$s</span></a></span></span>',
		_x( 'Author', 'Used before post author name.', 'sonsa' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);

}
endif;

if ( ! function_exists( 'sonsa_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function sonsa_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'sonsa' ) );
		if ( $categories_list && sonsa_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'sonsa' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'sonsa' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'sonsa' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'sonsa' ), esc_html__( '1 Comment', 'sonsa' ), esc_html__( '% Comments', 'sonsa' ) );
		echo '</span>';
	}
	
}
endif;

/**
 * This template tag is meant to replace template tags like `the_category()`, `the_terms()`, etc.  These core 
 * WordPress template tags don't offer proper translation and RTL support without having to write a lot of 
 * messy code within the theme's templates.  This is why theme developers often have to resort to custom 
 * functions to handle this (even the default WordPress themes do this).  Particularly, the core functions 
 * don't allow for theme developers to add the terms as placeholders in the accompanying text (ex: "Posted in %s"). 
 * This funcion is a wrapper for the WordPress `get_the_terms_list()` function.  It uses that to build a 
 * better post terms list.
 *
 * @author    Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-core/blob/2.0/functions/template-post.php
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @since  1.0.0
 * @param  array   $args
 * @return string
 */
function sonsa_get_post_terms( $args = array() ) {

	$html = '';

	$defaults = array(
		'post_id'    => get_the_ID(),
		'taxonomy'   => 'category',
		'text'       => '%s',
		'before'     => '',
		'after'      => '',
		'items_wrap' => '<span %s>%s</span>',
		/* Translators: Separates tags, categories, etc. when displaying a post. */
		'sep'        => _x( ', ', 'taxonomy terms separator', 'sonsa' )
	);

	$args = wp_parse_args( $args, $defaults );

	$terms = get_the_term_list( $args['post_id'], $args['taxonomy'], '', $args['sep'], '' );

	if ( !empty( $terms ) ) {
		$html .= $args['before'];
		$html .= sprintf( $args['items_wrap'], 'class="entry-terms ' . $args['taxonomy'] . '" ' . hybrid_get_attr( 'entry-terms', $args['taxonomy'] ) . '', sprintf( $args['text'], $terms ) );
		$html .= $args['after'];
	}

	return $html;
}

/**
 * Outputs a post's taxonomy terms.
 *
 * @since  1.0.0
 * @access public
 * @param  array   $args
 * @return void
 */
function sonsa_post_terms( $args = array() ) {
	echo sonsa_get_post_terms( $args );
}

if ( ! function_exists( 'sonsa_post_background' ) ) :
/**
 * Display an optional post background.
 *
 * @since 1.0.0
 */
function sonsa_post_background( $post_thumbnail = 'post-thumbnail' ) {
	if ( has_post_thumbnail() && ! is_single() ) :
		$thumb_id        = get_the_ID();
		$thumb_url_array = wp_get_attachment_image_src( get_post_thumbnail_id( $thumb_id ), esc_attr( $post_thumbnail ), true );
		$thumb_url       = $thumb_url_array[0];
		$bg              = 'style = "background-image : url(' . esc_url( $thumb_url ) . ');"';
	else :
		$bg = '';
	endif;
	
	return $bg;
}
endif;

if ( ! function_exists( 'sonsa_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since 1.0.0
 */
function sonsa_post_thumbnail() {

	if ( post_password_required() || is_attachment() ) {
		return;
	}

	if ( is_singular() && has_post_thumbnail() ) :
	?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumbnail -->

	<?php elseif( ! is_singular() ) : ?>
	
		<?php // Get default post image from the Customizer or from theme image folder.
			if( get_theme_mod( 'default_post_image' ) ) :
				$sonsa_default_image = wp_get_attachment_image_src( absint( get_theme_mod( '404_image' ) ), 'full' );
				$sonsa_default_image = $sonsa_default_image[0];
			else :
				$sonsa_default_image = get_stylesheet_directory_uri() . '/images/default-post-image.png';
			endif;
		 ?>
		 
			<?php
			$sonsa_post_format = get_post_format();
			if ( false === $sonsa_post_format ) {
				$sonsa_post_format = 'standard';
			}
			
			if ( 'status' === $sonsa_post_format ) :
				return;
			elseif ( has_post_thumbnail() ) :
			?>
		
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
					<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ); ?>
				</a>
			
			<?php endif; ?>

	<?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'sonsa_post_format' ) ) :
/**
 * Return post format element.
 *
 * @since 1.0.0
 */
function sonsa_post_format() {
	
	// Get post format.
	$sonsa_post_format = get_post_format();
	
	// Set default to standard.
	if ( false === $sonsa_post_format ) {
		$sonsa_post_format = 'standard';
	}
	
	// For link use external icon.
	if ( 'link' === $sonsa_post_format ) {
		$sonsa_post_format = 'external';
	}
	
	return '<div class="sonsa-post-format genericon genericon-' . $sonsa_post_format . '" aria-hidden="true"><span class="screen-reader-text">' . get_post_format_string( $sonsa_post_format ) . '</span></div>';
	
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function sonsa_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'sonsa_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'sonsa_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so sonsa_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so sonsa_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in sonsa_categorized_blog.
 */
function sonsa_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'sonsa_categories' );
}
add_action( 'edit_category', 'sonsa_category_transient_flusher' );
add_action( 'save_post',     'sonsa_category_transient_flusher' );
