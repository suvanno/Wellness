<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Wellness
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wellness_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( 'left' == get_theme_mod( 'wellness_sidebar_position' ) ) {
		$classes[] = 'left-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'wellness_body_classes' );


/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wellness_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wellness_custom_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wellness_excerpt_more( $more ) {
    return ' &hellip;';
}
add_filter( 'excerpt_more', 'wellness_excerpt_more' );

/**
 * Get random posts for any post type
 */
function wellness_get_random_posts( $number = 1, $post_type = 'post' ) {
	$query = new WP_Query( array(
		'posts_per_page' => 100,
		'fields'         => 'ids',
		'post_type'      => $post_type
	) );

	$post_ids = $query->posts;
	shuffle( $post_ids );
	$post_ids = array_splice( $post_ids, 0, $number );

	$random_posts = get_posts( array(
		'post__in'    => $post_ids,
		'numberposts' => count( $post_ids ),
		'post_type'   => $post_type
	) );

	return $random_posts;
}

/**
 * Add footer theme info
 */
function wellness_footer_credits(){
    ?>
    <div class=" site-info">
        <div class="container">
            <div class="site-copyright">
                <?php printf(esc_html__('Copyright %1$s %2$s %3$s. All Rights Reserved.', 'wellness'), '&copy;', date_i18n('Y'), get_bloginfo() ); ?>
            </div><!-- .site-copyright -->
            <div class="theme-info">
                <?php printf(esc_html__('Wellness theme by %1s.', 'wellness'), '<a href="https://daisythemes.com">DaisyThemes</a>' ); ?>
            </div>
        </div>
    </div><!-- .site-info -->
    <?php
}
add_action( 'wellness_footer', 'wellness_footer_credits' );
