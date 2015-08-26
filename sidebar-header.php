<?php
/**
 * Header Sidebar.
 *
 * @package Sonsa
 */
?>

<?php if ( is_active_sidebar( 'header' ) ) : // If the sidebar has widgets. ?>

	<aside id="sidebar-header" class="sidebar-header sidebar" role="complementary" <?php hybrid_attr( 'sidebar', 'header' ); ?>>
		<h2 class="screen-reader-text" id="sidebar-header-header"><?php echo esc_attr_x( 'Header Sidebar', 'Sidebar aria label', 'sonsa' ); ?></h2>
		
		<div class="wrap">
		
			<?php dynamic_sidebar( 'header' ); ?>
	
		</div><!-- .wrap -->

	</aside><!-- #sidebar-header .sidebar -->

<?php endif; // End layout check.