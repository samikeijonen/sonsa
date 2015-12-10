<?php
/**
 * The sidebar containing the main widget area and the main navigation.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sonsa
 */

if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'primary' ) || is_active_sidebar( 'header' ) || has_nav_menu( 'social' ) ) : ?>

	<div id="secondary" class="secondary">
	
		<div class="wrap">
		
			<button id="sidebar-nav-close" class="sidebar-nav-close sidebar-nav-toggle button-toggle"><span class="screen-reader-text"><?php esc_html_e( 'Collapse sidebar', 'sonsa' ); ?></span></button>
		
			<?php if ( is_active_sidebar( 'header' ) || has_nav_menu( 'social' ) ) : ?>		
						
				<div id="header-social-wrap-narrow" class="header-social-wrap header-social-wrap-narrow">
						
					<div class="wrap">	
						
						<?php if ( is_active_sidebar( 'header' ) ) : ?>
							
							<aside id="sidebar-header-narrow" class="sidebar-header sidebar" role="complementary" <?php hybrid_attr( 'sidebar', 'header' ); ?>>
								<h2 class="screen-reader-text" id="sidebar-header-header-narrow"><?php echo esc_attr_x( 'Header Sidebar', 'Sidebar aria label', 'sonsa' ); ?></h2>
							
								<?php dynamic_sidebar( 'header' ); // Loads the header sidebar. ?>
								
							</aside><!-- #sidebar-header-narrow .sidebar -->
							
						<?php endif; // End for header sidebar check. ?>
						
						<?php
							if ( has_nav_menu( 'social' ) ) :
								get_template_part( 'menu', 'social-narrow' ); // Loads the menu-social-narrow.php template.
							endif;
						?>
						
					</div><!-- .wrap -->
							
				</div><!-- .header-social-wrap -->
						
			<?php endif; ?>
			
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
			
				<nav id="site-navigation" class="main-navigation menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'sonsa' ); ?>" <?php hybrid_attr( 'menu', 'primary' ); ?>>
					<h2 class="screen-reader-text"><?php esc_attr_e( 'Primary Menu', 'sonsa' ); ?></h2>
				
					<h3 class="widget-title sonsa-menu-title"><?php echo esc_attr( sonsa_get_menu_name( 'primary' ) ) ?></h3>
					
					<?php
						// Primary navigation menu.
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id'        => 'menu-primary-items',
							'menu_class'     => 'menu-items',
							'depth'          => 2,
						) );
					?>
				
				</nav><!-- .main-navigation -->
			
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'primary' ) ) : ?>
		
				<aside id="sidebar-primary" class="sidebar-primary sidebar" role="complementary" <?php hybrid_attr( 'sidebar', 'primary' ); ?>>
					<?php dynamic_sidebar( 'primary' ); ?>
				</aside><!-- .widget-area -->
			
			<?php endif; ?>
			
		</div><!-- .wrap -->

	</div><!-- .secondary -->

<?php endif; ?>
