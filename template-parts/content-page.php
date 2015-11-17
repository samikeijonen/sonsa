<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sonsa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( 'page' ) ) : // If singular page. ?>
	
		<?php sonsa_post_thumbnail(); ?>
	
		<div class="inner-wrap">
	
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
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

