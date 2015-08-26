<?php
/**
 * Sonsa functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Sonsa
 */

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
	set_post_thumbnail_size( 960, 540, true );
	
	// Add custom image sizes.
	add_image_size( 'sonsa-site-logo', 192, 192, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html_x( 'Primary', 'nav menu location', 'sonsa' ),
		'social'  => esc_html_x( 'Social', 'nav menu location', 'sonsa' ),
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
	
	// Add theme support for site logo.
	add_theme_support( 'site-logo', array(
		'size' => 'sonsa-site-logo',
	) );
	
	// Add theme support for responsive videos.
	add_theme_support( 'jetpack-responsive-videos' );
	
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
	$GLOBALS['content_width'] = apply_filters( 'sonsa_content_width', 800 );
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
		'description'   => esc_html__( 'A sidebar located in the header of the site.', 'sonsa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
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
	
	/* Add Genericons font, used in the main stylesheet. */
	wp_enqueue_style( 'genericons', trailingslashit( get_template_directory_uri() ) . 'genericons/genericons.css', array(), '3.3.1' );
	
	// Enqueue parent theme styles if using child theme.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'sonsa-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css', array() );
	}
	
	// Enqueue active theme styles.
	wp_enqueue_style( 'sonsa-style', get_stylesheet_uri() );
	
	// Enqueue responsive navigation for off-canvas sidebar and menu.
	if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'primary' ) ) {
		wp_enqueue_script( 'sonsa-navigation', trailingslashit( get_template_directory_uri() ) . 'js/responsive-nav.js', array(), '20150815', true );
	}
	
	// Enqueue theme scripts.
	wp_enqueue_script( 'sonsa-scripts', trailingslashit( get_template_directory_uri() ) . 'js/scripts.js', array( 'sonsa-navigation' ), '20150815', true );

	wp_enqueue_script( 'sonsa-skip-link-focus-fix', trailingslashit( get_template_directory_uri() ). 'js/skip-link-focus-fix.js', array(), '20150815', true );
	
	// Enqueue comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'sonsa_scripts' );

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
			. _x(
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
			. _x(
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
			. _x(
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
 * Add placeholder for comment form textarea field.
 *
 * @since 1.0.0
 */
function sonsa_comment_form_textarea( $fields ) {

	// Add placeholder for textarea.
	$fields['comment_field'] = str_replace(
		'<textarea',
		'<textarea placeholder="'
			. _x(
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
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

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
