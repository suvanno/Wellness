<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Wellness
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function wellness_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'wellness_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
	// Add theme support for Testimonial post type
	add_theme_support( 'jetpack-testimonial' );

	// Add theme support for Featured Content
	add_theme_support( 'featured-content', array(
	    'filter'     => 'wellness_get_featured_posts',
	    'max_posts'  => 10,
	    'post_types' => array( 'post', 'page' ),
	) );
}
add_action( 'after_setup_theme', 'wellness_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function wellness_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}

/**
 * Get featured content posts.
 */
function wellness_get_featured_posts() {
    return apply_filters( 'wellness_get_featured_posts', array() );
}

/**
 * Check number of post the featured content returned.
 */
function wellness_has_featured_posts( $minimum = 1 ) {
    if ( is_paged() )
        return false;

    $minimum = absint( $minimum );
    $featured_posts = apply_filters( 'wellness_get_featured_posts', array() );

    if ( ! is_array( $featured_posts ) )
        return false;

    if ( $minimum > count( $featured_posts ) )
        return false;

    return true;
}

/**
 * Remove the Related Posts from the post content so we can add it after the post navigation.
 */
function wellness_jetpackme_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_filter( 'wp', 'wellness_jetpackme_remove_rp', 20 );
