<?php
/**
 * The template for displaying video post format content.
 *
 * @package Sonsa
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_single() ) : // If single. ?>
	
		<?php echo ( $video = hybrid_media_grabber( array( 'type' => 'video', 'split_media' => true, 'before' => '<div class="entry-media">', 'after' => '</div>' ) ) ); ?>
	
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
	
		<?php sonsa_post_thumbnail(); ?>
		
		<header class="entry-header-info">
			<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header-info -->
		
		<?php echo sonsa_post_format(); ?>
		
	<?php endif; // End check single. ?>
	
</article><!-- #post-## -->