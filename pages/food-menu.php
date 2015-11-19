<?php
/**
 * Template Name: Food Menu
 *
 * This is the template that displays food menu.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sonsa
 */

// Set menu title tag as h2.
if ( class_exists( 'Nova_Restaurant' ) ) {
	Nova_Restaurant::init( array(
		'menu_title_tag' => 'h2',
	) );
}

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php
			// Get post background image.
			$sonsa_bg = sonsa_post_background( $post_thumbnail = 'full' );
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?> <?php if ( has_post_thumbnail() ) echo ' style="background-image:url(' . esc_url( $sonsa_bg ) . ');"' ?>>
		
			<div class="entry-inner">
		
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
				
				</div><!-- .entry-content -->
			
			</div><!-- .entry-inner -->
	
		</article><!-- #post-## -->
		
		<?php
					$loop = new WP_Query( array( 'post_type' => 'nova_menu_item' ) );
					while ( $loop->have_posts() ) : $loop->the_post();
						get_template_part( 'template-parts/content', 'nova_menu_item' );
					endwhile; // end of the Menu Item Loop
					wp_reset_postdata();
					
		?>

	<?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>
