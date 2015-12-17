<?php
/**
 * Sonsa functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Sonsa
 */
 
/**
 * The current version of the theme.
 */
define( 'SONSA_VERSION', '1.0.0' );

if ( ! function_exists( 'sonsa_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sonsa_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Sonsa, use a find and replace
	 * to change 'sonsa' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'sonsa', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 960, 9999, false );
	
	// Add custom image sizes.
	add_image_size( 'sonsa-site-logo', 192, 192, true );

	// This theme uses wp_nav_menu() in three locations.
	register_nav_menus( array(
		'primary'   => esc_html_x( 'Primary', 'nav menu location', 'sonsa' ),
		'social'    => esc_html_x( 'Social', 'nav menu location', 'sonsa' ),
		'portfolio' => esc_html_x( 'Portfolio', 'nav menu location', 'sonsa' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'audio',
		'chat',
		'gallery',
		'image',
		'link',
		'quote',
		'status',
		'video',
	) );
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', sonsa_fonts_url() ) );

}
endif; // sonsa_setup
add_action( 'after_setup_theme', 'sonsa_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sonsa_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sonsa_content_width', 960 );
}
add_action( 'after_setup_theme', 'sonsa_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sonsa_widgets_init() {
	
	// Primary widget arguments.
	$sidebar_primary_args = array(
		'id'            => 'primary',
		'name'          => esc_html_x( 'Primary', 'sidebar', 'sonsa' ),
		'description'   => esc_html__( 'The main sidebar. It is displayed in the off-canvas menu.', 'sonsa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	);

	// Header widget arguments.	
	$sidebar_header_args = array(
		'id'            => 'header',
		'name'          => esc_html_x( 'Header', 'sidebar', 'sonsa' ),
		'description'   => esc_html__( 'A sidebar located in the header of the site. For optimal layout it is recommended to use only one short widget.', 'sonsa' ),
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	);

	// Register sidebars.
	register_sidebar( $sidebar_primary_args );
	register_sidebar( $sidebar_header_args );
	
}
add_action( 'widgets_init', 'sonsa_widgets_init' );

/**
 * Return the Google font stylesheet URL
 */
function sonsa_fonts_url() {

	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Roboto, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$roboto = _x( 'on', 'Roboto font: on or off', 'sonsa' );

	if ( 'off' !== $roboto ) {
		
		$font_families = array();

		$font_families[] = 'Roboto:400,700,400italic,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function sonsa_scripts() {
	
	// Enqueue fonts.
	wp_enqueue_style( 'sonsa-fonts', sonsa_fonts_url(), array(), null );
	
	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', trailingslashit( get_template_directory_uri() ) . 'genericons/genericons.css', array(), '3.3.1' );
	
	// Enqueue parent theme styles if using child theme.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'sonsa-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css', array() );
	}
	
	// Enqueue active theme styles.
	wp_enqueue_style( 'sonsa-style', get_stylesheet_uri() );
	
	// Enqueue perfect scrollbar script.
	wp_enqueue_script( 'sonsa-perfect-scrollbar', trailingslashit( get_template_directory_uri() ). 'js/perfect-scrollbar.js', array(), '20150815', true );
	
	// Enqueue enquire script.
	wp_enqueue_script( 'sonsa-enquire', trailingslashit( get_template_directory_uri() ). 'js/enquire.js', array(), '20150815', true );
	
	// Enqueue theme scripts.
	wp_enqueue_script( 'sonsa-scripts', trailingslashit( get_template_directory_uri() ) . 'js/scripts.js', array( 'sonsa-perfect-scrollbar', 'sonsa-enquire' ), '20150815', true );
	
	// Enqueue theme settings.
	wp_enqueue_script( 'sonsa-settings', trailingslashit( get_template_directory_uri() ) . 'js/settings.js', array( 'jquery' ), '20150815', true );
	wp_localize_script( 'sonsa-settings', 'screenReaderText', array(
		'expand'         => '<span class="screen-reader-text">' . esc_html__( 'Expand sidebar', 'sonsa' ) . '</span>',
		'collapse'       => '<span class="screen-reader-text">' . esc_html__( 'Collapse sidebar', 'sonsa' ) . '</span>',
	) );
	
	// Enqueue skip link script.
	wp_enqueue_script( 'sonsa-skip-link-focus-fix', trailingslashit( get_template_directory_uri() ). 'js/skip-link-focus-fix.js', array(), '20150815', true );
		
	// Enqueue comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'sonsa_scripts' );

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @author    Twenty Fifteen
 * @copyright Automattic
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @since 1.0.0
 */
function sonsa_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'sonsa_javascript_detection', 0 );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @author    Twenty Fifteen
 * @copyright Automattic
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @since 1.0.0
 * @see wp_add_inline_style()
 */
function sonsa_post_nav_background() {
	
	if ( ! is_single() ) {
		return;
	}
	
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';
	
	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}
	
	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'thumbnail' );
		$css .= '
			@media screen and (min-width: 300px) {
				.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
				.post-navigation .nav-previous { background-repeat: no-repeat; }
				.post-navigation .nav-previous { background-position: left center; }
				.post-navigation .nav-previous { padding-left: 0; }
				.post-navigation .nav-previous a { padding-left: 171px; }
			}
		';
	}
	
	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'thumbnail' );
		$css .= '
			@media screen and (min-width: 300px) {
				.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); }
				.post-navigation .nav-next { background-repeat: no-repeat; }
				.post-navigation .nav-next { background-position: right center; }
				.post-navigation .nav-next { padding-right: 0; }
				.post-navigation .nav-next a { padding-right: 171px; }
			}
		';
	}
	
	if ( $previous &&  has_post_thumbnail( $previous->ID ) || $next && has_post_thumbnail( $next->ID ) ) {
		$css .= '
			@media screen and (min-width: 300px) {
				.post-navigation .nav-previous a, .post-navigation .nav-next a { min-height: 150px; }
				.post-navigation a { padding-top: 21px; padding-bottom: 21px }
			}
		';
	
	}
	
	wp_add_inline_style( 'sonsa-style', $css );
	
}
add_action( 'wp_enqueue_scripts', 'sonsa_post_nav_background' );

/**
 * Add placeholders for comment form.
 *
 * @since 1.0.0
 */
function sonsa_comment_form_fields( $fields ) {
	
	// Required field.
	$req = get_option( 'require_name_email' );
	
	// Add placeholder for name.
	$fields['author'] = str_replace(
		'<input',
		'<input placeholder="'
			. esc_html_x(
				'Name',
				'comment form placeholder for name',
				'sonsa'
				)
			. ( $req ? ' *' : '' ) . '"',
		$fields['author']
	);
	
	// Add placeholder for email.
	$fields['email'] = str_replace(
		'<input',
		'<input placeholder="'
			. esc_html_x(
				'Email',
				'comment form placeholder for email',
				'sonsa'
				)
			. ( $req ? ' *' : '' ) . '"',
		$fields['email']
	);
	
	// Add placeholder for url.
	$fields['url'] = str_replace(
		'<input',
		'<input placeholder="'
			. esc_html_x(
				'Website',
				'comment form placeholder for website',
				'sonsa'
				)
			. '"',
		$fields['url']
	);
	
	// Add screen reader class for labels.
	$fields['author'] = str_replace(
		'<label',
		'<label class="screen-reader-text"',
		$fields['author']
	);
	
	$fields['email'] = str_replace(
		'<label',
		'<label class="screen-reader-text"',
		$fields['email']
	);

	$fields['url'] = str_replace(
		'<label',
		'<label class="screen-reader-text"',
		$fields['url']
	);
 
	return $fields;
	
}
add_filter( 'comment_form_default_fields', 'sonsa_comment_form_fields' );

/**
 * Add body classes.
 *
 * @param  array  $classes  body classes.
 * @return array  $classes  body classes.
 * @since  1.0.0
 */
function sonsa_extra_body_classes( $classes ) {
	
	// Add the '.custom-header-image' class if the user is using a custom header image.
	if ( get_header_image() ) {
		$classes[] = 'custom-header-image';
	}
	
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	// Adds a class to 404 page if there is image set in the Customizer.
	if ( is_404() && get_theme_mod( '404_image' ) ) {
		$classes[] = 'has-404-image';
	}
	
    return $classes;
	
}
add_filter( 'body_class', 'sonsa_extra_body_classes' );

/**
 * Change excerpt length.
 *
 * @since 1.0.0
 */
function sonsa_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'sonsa_excerpt_length' );

/**
 * Change [...] to ... Read more.
 *
 * @since 1.0.0
 */
function sonsa_excerpt_more() {

	$more = esc_html_x( '&hellip;', 'mark after excerpt', 'sonsa' );
	return $more;

}
add_filter( 'excerpt_more', 'sonsa_excerpt_more' );

/**
 * Add placeholder for comment form textarea field.
 *
 * @since 1.0.0
 */
function sonsa_comment_form_textarea( $fields ) {

	// Add placeholder for textarea.
	$fields['comment_field'] = str_replace(
		'<textarea',
		'<textarea placeholder="'
			. esc_html_x(
				'Comment',
				'comment form placeholder for comment field. It is noun.',
				'sonsa'
				)
			. '"',
		$fields['comment_field']
	);
	
	// Add screen reader class for comment field.
	$fields['comment_field'] = str_replace(
		'<label',
		'<label class="screen-reader-text"',
		$fields['comment_field']
	);

	return $fields;

}

add_filter( 'comment_form_defaults', 'sonsa_comment_form_textarea' );

/**
 * Add an HTML class to MediaElement.js container elements to aid styling.
 *
 * Extends the core _wpmejsSettings object to add a new feature via the
 * MediaElement.js plugin API.
 *
 * @author     Brady Vercher
 * @copyright  Brady Vercher
 * @link       http://www.cedaro.com/blog/customizing-mediaelement-wordpress/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @since  1.0.0
 * @return void
 */
function sonsa_mejs_add_container_class() {
	
	// Check do we have media element.
	if ( ! wp_script_is( 'mediaelement', 'done' ) ) {
		return;
	}

	?>
	<script>
	(function() {
		var settings = window._wpmejsSettings || {};
		settings.features = settings.features || mejs.MepDefaults.features;
		settings.features.push( 'SonsaClass' );

		MediaElementPlayer.prototype.buildSonsaClass = function( player ) {
			player.container.addClass( 'sonsa-mejs-container' );
		};
	})();
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'sonsa_mejs_add_container_class' );

/**
 * Use a template for individual comment output.
 *
 * @param object $comment Comment to display.
 * @param int    $depth   Depth of comment.
 * @param array  $args    An array of arguments.
 *
 * @since 1.0.0
 */
function sonsa_comment_callback( $comment, $args, $depth ) {
	include( locate_template( 'comment.php') );
}

/**
 * Function for grabbing a WP nav menu name based on theme location.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $location
 * @return string
 */
function sonsa_get_menu_name( $location ) {
	
	$locations = get_nav_menu_locations();
	return isset( $locations[ $location ] ) ? wp_get_nav_menu_object( $locations[ $location ] )->name : '';
	
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Custom Background feature.
 */
require get_template_directory() . '/inc/custom-background.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Schema.org file.
 */
require get_template_directory() . '/inc/schema.php';

/**
 * Load media grabber file.
 */
require get_template_directory() . '/inc/media-grabber.php';

/**
 * Load post format file.
 */
require get_template_directory() . '/inc/functions-formats.php';

/**
 * Load chat format file.
 */
require get_template_directory() . '/inc/class-chat.php';

/**
 * Load archive filters file.
 */
require get_template_directory() . '/inc/archive-filters.php';

/**
 * Add theme settings for license.
 */
function sonsa_theme_updater() {
	require_once( get_template_directory() . '/theme-updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'sonsa_theme_updater' );