<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Sonsa
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'template-parts/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

		<?php
		// How many words to show.
		$number_of_words = apply_filters( 'sonsa_how_many_words', 7 );
			
		// Previous/next post navigation.
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav next-post" aria-hidden="true">' . esc_html__( 'Next', 'sonsa' ) . '</span> ' .
				'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'sonsa' ) . '</span> ' .
				'<span class="post-title">' . wp_trim_words( get_next_post_link( $format = '%link' ), absint( $number_of_words ), _x( '&hellip;', 'dots after next post link', 'sonsa' ) ) . '</span>',
			'prev_text' => '<span class="meta-nav previous-post" aria-hidden="true">' . esc_html__( 'Previous', 'sonsa' ) . '</span> ' .
				'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'sonsa' ) . '</span> ' .
				'<span class="post-title">' . wp_trim_words( get_previous_post_link( $format = '%link' ), absint( $number_of_words ), _x( '&hellip;', 'dots after previous post link', 'sonsa' ) ) . '</span>',
		) );
		?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>

	<?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>
