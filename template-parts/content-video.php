<?php
/**
 * The template for displaying video post format content.
 *
 * @package Sonsa
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If single view. ?>
	
		<?php echo ( $video = hybrid_media_grabber( array( 'type' => 'video', 'split_media' => true, 'before' => '<div class="entry-media">', 'after' => '</div>' ) ) ); ?>
	
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
		
		<?php get_template_part( 'entry', 'footer' ); // Loads the entry-footer.php template. ?>
		
	<?php else : ?>
	
		<?php $sonsa_bg = sonsa_post_background(); // Get featured image as post background image. ?>
			
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			
			<div class="entry-bg-image"<?php if ( false !== $sonsa_bg ) echo ' style="background-image:url(' . esc_url( $sonsa_bg ) . ');"' ?>>
				
				<header class="entry-header-info">
					<?php the_title( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h2>' ); ?>
					<?php sonsa_posted_on( $human_diff = true ); ?>
				</header><!-- .entry-header-info -->
				
				<?php echo sonsa_post_format(); ?>
				
			</div><!-- .entry-bg-image -->
			
		</a>
		
	<?php endif; // End check single. ?>
	
</article><!-- #post-## -->