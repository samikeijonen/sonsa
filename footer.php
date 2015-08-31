<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sonsa
 */

?>

					<?php
						the_posts_pagination( array(
							'prev_text'          => __( 'Previous page', 'sonsa' ),
							'next_text'          => __( 'Next page', 'sonsa' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'sonsa' ) . ' </span>',
						) );
					?>
		
					<footer id="colophon" class="site-footer" role="contentinfo" <?php hybrid_attr( 'footer' ); ?>>
			
						<div class="site-info">
							<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'sonsa' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'sonsa' ), 'WordPress' ); ?></a>
							<span class="sep"> | </span>
							<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'sonsa' ), 'sonsa', '<a href="http://foxland.fi/" rel="designer">Foxland</a>' ); ?>
						</div><!-- .site-info -->
					</footer><!-- #colophon -->

				</main><!-- #main -->
			</div><!-- #primary -->

		</div><!-- #content -->
	
		<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>
		
	</div><!-- .site-wrapper -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
