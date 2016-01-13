<?php
/**
 * Header Sidebar.
 *
 * @package Sonsa
 */
?>

<?php if ( is_active_sidebar( 'header' ) ) : // If the sidebar has widgets. ?>

	<aside id="sidebar-header" class="sidebar-header sidebar" role="complementary" <?php hybrid_attr( 'sidebar', 'header' ); ?>>
		
		<div class="wrap">
		
			<?php dynamic_sidebar( 'header' ); ?>
	
		</div><!-- .wrap -->

	</aside><!-- #sidebar-header .sidebar -->

<?php endif; // End layout check.