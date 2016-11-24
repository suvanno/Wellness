<?php
/**
 * Wellness functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wellness
 */

if ( ! function_exists( 'wellness_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wellness_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Wellness, use a find and replace
	 * to change 'wellness' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wellness', get_template_directory() . '/languages' );

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
	 * Enable support for custom logo.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 240,
		'flex-width'  => true,
		'flex-height' => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'wellness-hero', 1140, 600, true );
	add_image_size( 'wellness-featured-image', 790, 500, true );
	add_image_size( 'wellness-thumbnail-landscape', 360, 240, true );
	add_image_size( 'wellness-thumbnail-avatar', 100, 100, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'wellness' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wellness_custom_background_args', array(
		'default-color' => '#f3f4f6',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'wellness_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wellness_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wellness_content_width', 738 );
}
add_action( 'after_setup_theme', 'wellness_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wellness_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'wellness' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wellness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'First Footer Widget Area', 'wellness' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'wellness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Second Footer Widget Area', 'wellness' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'wellness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Third Footer Widget Area', 'wellness' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here.', 'wellness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Fourth Footer Widget Area', 'wellness' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Add widgets here.', 'wellness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'wellness_widgets_init' );

/**
 * Add Google Fonts, editor styles to WYSIWYG editor
 */
function wellness_editor_styles() {
	add_editor_style( array( 'assets/css/editor-style.css', wellness_fonts_url() ) );
}
add_action( 'after_setup_theme', 'wellness_editor_styles' );

/**
 * Enqueue scripts and styles.
 */
function wellness_scripts() {
	wp_enqueue_style( 'wellness-fonts', wellness_fonts_url(), array(), null );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.6.1' );
	wp_enqueue_style( 'wellness-style', get_stylesheet_uri() );

	if ( (is_page_template( 'templates/front-page.php' ) && wellness_has_featured_posts( 2 ) ) || (is_page_template( 'templates/front-page.php' ) && get_theme_mod( 'wellness_testimonial_layout_front_page' ) == 'slider' ) ) {
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', array(), '20140523', true );
	}
	wp_enqueue_script( 'wellness-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'wellness-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'wellness-script', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), '20160412', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wellness_scripts' );

if ( ! function_exists( 'wellness_fonts_url' ) ) :
/**
* Register Google fonts.
* Create your own wellness_fonts_url() function to override in a child theme.
*/
function wellness_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merienda, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merienda font: on or off', 'wellness' ) ) {
		$fonts[] = 'Merienda:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'wellness' ) ) {
		$fonts[] = 'Roboto:300,300i,400,400i,500,500i,700,700i';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Load plugin enhancement file.
 */
require get_template_directory() . '/inc/plugin-enhancements.php';
