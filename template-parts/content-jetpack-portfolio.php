<?php
/**
 * Template part for displaying portfolios.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sonsa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If single view. ?>
	
		<?php sonsa_post_thumbnail(); ?>
		
		<div class="inner-wrap">
	
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
				<?php get_template_part( 'entry', 'meta' ); // Loads the entry-meta.php template. ?>
			</header><!-- .entry-header -->
		
			<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
			
				<?php the_content(); ?>

				<?php
					wp_link_pages( array(
						'before'    => '<div class="page-links">' . esc_html__( 'Pages:', 'sonsa' ),
						'after'     => '</div>',
						'pagelink'  => '<span class="screen-reader-text">' . esc_html__( 'Page', 'sonsa' ) . ' </span>%',
						'separator' => '<span class="screen-reader-text">,</span> ',
					) );
				?>
				
			</div><!-- entry-content -->
			
		</div><!-- .inner-wrap -->
		
		<footer class="entry-footer">
			<div class="entry-footer-wrap">
				<?php sonsa_post_terms( array( 'taxonomy' => 'jetpack-portfolio-type', 'before' => '<div class="entry-categories"><span class="terms-title categories-title"><span class="terms-title-wrap screen-reader-text">' . esc_html__( 'Categories', 'sonsa' ) . '</span></span>', 'after' => '</div>' ) ); ?>
				<?php sonsa_post_terms( array( 'taxonomy' => 'jetpack-portfolio-tag', 'before' => '<div class="entry-tags"><span class="terms-title tags-title"><span class="terms-title-wrap screen-reader-text">' . esc_html__( 'Tags', 'sonsa' ) . '</span></span>', 'after' => '</div>' ) ); ?>
			</div><!-- .entry-footer-wrap -->
		</footer><!-- .entry-footer -->
		
	<?php else : ?>
	
		<?php $sonsa_bg = sonsa_post_background(); // Get featured image as post background image. ?>
			
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			
			<div class="entry-bg-image"<?php if ( false !== $sonsa_bg ) echo ' style="background-image:url(' . esc_url( $sonsa_bg ) . ');"' ?>>
				
				<header class="entry-header-info">
					<?php the_title( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h2>' ); ?>
				</header><!-- .entry-header-info -->
				
			</div><!-- .entry-bg-image -->
			
		</a>

	<?php endif; // End check single. ?>
	
</article><!-- #post-## -->
