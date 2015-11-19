<?php
/**
 * Portfolio links menu.
 *
 * @package Sonsa
 */
?>

<nav id="menu-portfolio" class="menu menu-portfolio" role="navigation" aria-label="<?php esc_attr_e( 'Porfolio Menu', 'sonsa' ); ?>" <?php hybrid_attr( 'menu', 'portfolio' ); ?>>
	<h2 class="screen-reader-text"><?php esc_attr_e( 'Portfolio Menu', 'sonsa' ); ?></h2>
	
	<?php if ( has_nav_menu( 'portfolio' ) ) : // Check if there's a menu assigned to the 'portfolio' location. ?>
		
		<?php wp_nav_menu(
			array(
				'theme_location'  => 'portfolio',
				'container'       => 'div',
				'container_class' => 'wrap',
				'menu_id'         => 'menu-portfolio-items',
				'menu_class'      => 'menu-portfolio-items menu-items',
				'depth'           => 1,
				'fallback_cb'     => '',
				'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
			)
		); ?>

	<?php else : // If there's no assigned 'portfolio' menu. ?>

		<ul id="menu-portfolio-items" class="menu-portfolio-items menu-items">
			<?php $type = get_post_type_object( 'jetpack-portfolio' ); ?>

			<li <?php echo is_post_type_archive( 'jetpack-portfolio' ) ? 'class="current-cat"' : ''; ?>>
				<a href="<?php echo get_post_type_archive_link( 'jetpack-portfolio' ); ?>">
					<?php 
						/* Translators: "All" is a link that points to the portfolio archive. */
						esc_html_e( 'All', 'sonsa' );
					?>
				</a>
			</li>

			<?php wp_list_categories( 
				array( 
					'taxonomy'         => 'jetpack-portfolio-type', 
					'depth'            => 1, 
					'hierarchical'     => false,
					'show_option_none' => false,
					'title_li'         => false,
				) 
			); ?>
		</ul>

	<?php endif; // End check for 'portfolio' menu. ?>

</nav><!-- #menu-portfolio -->