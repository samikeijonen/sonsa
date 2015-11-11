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
	$sonsa_bg = sonsa_post_background( $post_thumbnail = 'full' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?> tabindex="0"<?php if ( has_post_thumbnail() ) echo ' style="background-image:url(' . esc_url( $sonsa_bg ) . ');"' ?>>
		
	<div class="entry-inner">
		
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
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
			
	</div><!-- .entry-inner -->
	
</article><!-- #post-## -->
