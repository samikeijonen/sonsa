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

				</main><!-- #main -->
				
				<?php
					the_posts_pagination( array(
						'prev_text'          => esc_html__( 'Previous page', 'sonsa' ),
						'next_text'          => esc_html__( 'Next page', 'sonsa' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'sonsa' ) . ' </span>',
					) );
				?>
		
				<footer id="colophon" class="site-footer" role="contentinfo" <?php hybrid_attr( 'footer' ); ?>>
			
					<div class="site-info">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'sonsa' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'sonsa' ), 'WordPress' ); ?></a>
						<span class="sep"> | </span>
						<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'sonsa' ), 'sonsa', '<a href="https://foxland.fi/">Foxland</a>' ); ?>
					</div><!-- .site-info -->
				</footer><!-- #colophon -->
				
			</div><!-- #primary -->

		</div><!-- #content -->
		
	</div><!-- .site-wrapper -->
	
	<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
