<?php
/**
 * Template part for displaying aside posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sonsa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

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
		
		<?php get_template_part( 'entry', 'footer' ); // Loads the entry-footer.php template. ?>
		
	<?php else : ?>
	
		<?php echo sonsa_post_format(); ?>
		
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<div class="entry-summary" <?php hybrid_attr( 'entry-summary' ); ?>>
				<div class="wrap">
					<?php the_excerpt(); ?>
				</div><!-- .wrap -->
			</div><!-- .entry-summary -->
		</a>

	<?php endif; // End check single. ?>
	
</article><!-- #post-## -->
