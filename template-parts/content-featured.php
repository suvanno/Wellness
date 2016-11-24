<?php
/**
 * Template part for displaying featured posts.
 *
 * @package Wellness
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="featured-post-slide-meta animated">
        <h2><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_attr( get_the_title() ); ?></a></h2>
        <p><?php echo wp_trim_words( get_the_content(), 30, '&hellip;' ); ?></p>
        <span class="slide-readmore"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php esc_html_e( 'Read More', 'wellness' )?></a></span>
    </div><!-- .featured-post-slide-meta -->

    <div class="featured-post-media">
        <?php if ( has_post_thumbnail() ) the_post_thumbnail( 'wellness-hero' ); ?>
    </div>
</article>
