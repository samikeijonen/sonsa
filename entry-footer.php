<?php
/**
 * Entry footer.
 *
 * @package Sonsa
 */
?>

<?php if ( 'post' == get_post_type() ) : ?>
	<footer class="entry-footer">
		<div class="entry-footer-wrap">
			<?php sonsa_post_terms( array( 'taxonomy' => 'category', 'before' => '<div class="entry-categories"><span class="terms-title categories-title"><span class="terms-title-wrap screen-reader-text">' . esc_html__( 'Categories', 'sonsa' ) . '</span></span>', 'after' => '</div>' ) ); ?>
			<?php sonsa_post_terms( array( 'taxonomy' => 'post_tag', 'before' => '<div class="entry-tags"><span class="terms-title tags-title"><span class="terms-title-wrap screen-reader-text">' . esc_html__( 'Tags', 'sonsa' ) . '</span></span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-footer-wrap -->
	</footer><!-- .entry-footer -->
<?php endif;