<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Sonsa
 */

get_header(); ?>

	<?php if( get_theme_mod( '404_image' ) ) : // Check if there is 404 image
	
		// Get 404 page image.
		$sonsa_404_image = wp_get_attachment_image_src( absint( get_theme_mod( '404_image' ) ), 'full' );
	?>

		<div class="post-thumbnail">
			<img src="<?php echo esc_url( $sonsa_404_image[0] ); ?>" alt="<?php esc_html_e( '404 page', 'sonsa' ) ?>" />
		</div><!-- .post-thumbnail -->
		
	<?php endif; ?>

	<section class="error-404 not-found">
	
		<div class="inner-wrap">
		
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'sonsa' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'sonsa' ); ?></p>

				<?php get_search_form(); ?>

				<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

				<?php if ( sonsa_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'sonsa' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
				<?php endif; ?>

				<?php
					/* translators: %1$s: smiley */
					$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'sonsa' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
				?>

				<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

			</div><!-- .page-content -->
			
		</div><!-- .inner-wrap -->
			
	</section><!-- .error-404 -->

<?php get_footer(); ?>
