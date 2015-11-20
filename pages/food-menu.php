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

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?> <?php if ( has_post_thumbnail() ) echo ' style="background-image:url(' . esc_url( $sonsa_bg ) . ');"' ?>>
		
			<div class="entry-inner">
		
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
				</header><!-- .entry-header -->
		
				<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			
			</div><!-- .entry-inner -->
	
		</article><!-- #post-## -->
		
		<?php // Food menu items.
			$menu_items = new WP_Query( apply_filters( 'sonsa_food_menu_arguments', array(
				'post_type'      => 'nova_menu_item',
				'posts_per_page' => 500,
				'no_found_rows'  => true,
			) ) );
			
			if ( $menu_items->have_posts() ) :

				while ( $menu_items->have_posts() ) : $menu_items->the_post();
					get_template_part( 'template-parts/content', 'nova_menu_item' );
				endwhile;

			endif; // End loop.
			wp_reset_postdata(); // Reset post data.
		?>

	<?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>
