<?php
/**
 * Template part for displaying food items.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sonsa
 */
 
// Get menu item price.
$menu_item_price = get_post_meta( get_the_ID(), 'nova_price', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If single view. ?>
	
		<?php sonsa_post_thumbnail(); ?>
		
		<div class="inner-wrap">
	
			<header class="entry-header">
				
				<h1 class="entry-title">
					<?php
						// the title.
						the_title();
						
						// Menu item price.
						if ( isset( $menu_item_price ) && ! empty( $menu_item_price ) ) :
							echo '<span class="menu-item-price">' . esc_html( $menu_item_price ) . '</span>';
						endif;
					?>
				</h1>
				
			</header><!-- .entry-header -->
		
			<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
			
				<?php the_content(); ?>
				
				<?php
					wp_link_pages( array(
						'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'sonsa' ),
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'sonsa' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">,</span> ',
					) );
				?>
				
				<?php
					edit_post_link(
						sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'sonsa' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
						),
						'<p class="edit-link-p edit-link-menu-p"><span class="edit-link">',
						'</span></p>'
					);
				?>
				
			</div><!-- entry-content -->
			
		</div><!-- .inner-wrap -->
		
		<footer class="entry-footer">
			<div class="entry-footer-wrap">
				<?php sonsa_post_terms( array( 'taxonomy' => 'nova_menu_item_label', 'sep' => ' ', 'before' => '<div class="entry-menu-label"><span class="terms-menu-item menu-label-title"><span class="terms-title-wrap screen-reader-text">' . esc_html__( 'Menu Labels:', 'sonsa' ) . '</span></span>', 'after' => '</div>' ) ); ?>
			</div><!-- .entry-footer-wrap -->
		</footer><!-- .entry-footer -->
		
	<?php else : ?>
	
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="menu-item-thumbnail">
				<?php the_post_thumbnail( 'sonsa-thumbnail' ); ?>
			</div><!-- .post-thumbnail -->
		<?php endif; ?>
		
		<div class="entry-wrap">
				
			<header class="menu-entry-header">
			
				<h2 class="entry-title">
					<?php
						// the title.
						the_title();
						
						// Menu item price.
						if ( isset( $menu_item_price ) && ! empty( $menu_item_price ) ) :
							echo '<span class="menu-item-price">' . esc_html( $menu_item_price ) . '</span>';
						endif;
					?>
				</h2>
			
			</header><!-- .menu-entry-header -->
		
			<div class="menu-entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
				<?php the_content(); ?>
				
				<?php
					edit_post_link(
						sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'sonsa' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
						),
						'<p class="edit-link-p edit-link-menu-p"><span class="edit-link">',
						'</span></p>'
					);
				?>
				
				<?php sonsa_post_terms( array( 'taxonomy' => 'nova_menu_item_label', 'sep' => ' ', 'before' => '<div class="entry-menu-label"><span class="terms-menu-item menu-label-title"><span class="terms-title-wrap screen-reader-text">' . esc_html__( 'Menu Labels:', 'sonsa' ) . '</span></span>', 'after' => '</div>' ) ); ?>
			</div><!-- entry-content -->
			
		</div><!-- entry-wrap -->

	<?php endif; // End check single. ?>
	
</article><!-- #post-## -->
