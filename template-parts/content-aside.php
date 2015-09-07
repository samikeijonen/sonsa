<?php
/**
 * Template part for displaying aside posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sonsa
 */

?>

<?php
	// Get post background image.
	$bg = sonsa_post_background();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?> <?php echo $bg; ?>>

	<?php if ( is_single() ) : // If single. ?>
	
		<?php sonsa_post_thumbnail(); ?>
	
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
			<?php get_template_part( 'entry', 'meta' ); // Loads the entry-meta.php template. ?>
		</header><!-- .entry-header -->
		
		<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
			
			<?php the_content(); ?>

			<?php
				wp_link_pages( array(
					'before'    => '<div class="page-links">' . __( 'Pages:', 'sonsa' ),
					'after'     => '</div>',
					'pagelink'  => '<span class="screen-reader-text">' . __( 'Page', 'sonsa' ) . ' </span>%',
					'separator' => '<span class="screen-reader-text">,</span> ',
				) );
			?>
			
		</div><!-- .entry-content -->
		
		<footer class="entry-footer">
			<?php sonsa_post_terms( array( 'taxonomy' => 'category', 'text' => __( '<span class="screen-reader-text">Posted in</span> %s', 'sonsa' ) ) ); ?>
			<?php sonsa_post_terms( array( 'taxonomy' => 'post_tag', 'text' => __( '<span class="screen-reader-text">Tagged</span> %s', 'sonsa' ) ) ); ?>
		</footer><!-- .entry-footer -->
		
	<?php else : ?>
	
		<div class="wrap">
		
			<?php echo sonsa_post_format(); ?>
		
			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
				<div class="entry-summary" <?php hybrid_attr( 'entry-summary' ); ?>>
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			</a>
			
		</div><!-- .wrap -->

	<?php endif; // End check single. ?>
	
</article><!-- #post-## -->
