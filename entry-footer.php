<?php
/**
 * Entry footer.
 *
 * @package Sonsa
 */
?>

<?php if ( 'post' == get_post_type() ) : ?>
	
	<footer class="entry-footer">
	
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'sonsa' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<p class="edit-link-p edit-link-single-p"><span class="edit-link">',
				'</span></p>'
			);
		?>
	
		<div class="entry-footer-wrap">
			<?php sonsa_post_terms( array( 'taxonomy' => 'category', 'before' => '<div class="entry-categories"><span class="terms-title categories-title"><span class="terms-title-wrap screen-reader-text">' . esc_html__( 'Categories', 'sonsa' ) . '</span></span>', 'after' => '</div>' ) ); ?>
			<?php sonsa_post_terms( array( 'taxonomy' => 'post_tag', 'before' => '<div class="entry-tags"><span class="terms-title tags-title"><span class="terms-title-wrap screen-reader-text">' . esc_html__( 'Tags', 'sonsa' ) . '</span></span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-footer-wrap -->
	</footer><!-- .entry-footer -->
	
<?php endif;