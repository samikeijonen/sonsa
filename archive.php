<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sonsa
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<header class="page-header archive-header">
			<?php
				the_archive_title( '<h1 class="page-title archive-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description archive-description">', '</div>' );
				
				if ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) :
					get_template_part( 'menu', 'portfolio' ); // Loads menu-portfolio.php template file.
				endif;
			?>
		</header><!-- .page-header -->
		
		<?php
			// Extra wrapper for Portfolio.
			if ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) :
				echo '<div class="portfolio-wrapper">';
			endif;
		?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
				?>

			<?php endwhile; ?>
		
		<?php
			// Extra wrapper for Portfolio.
			if ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) :
				echo '</div><!-- .portfolio-wrapper -->';
			endif;
		?>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>
	
<?php get_footer(); ?>
