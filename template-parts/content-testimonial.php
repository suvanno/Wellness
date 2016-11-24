<?php
/**
 * The template used for displaying testimonials in a grid style.
 *
 * @package Wellness
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('grid-md-6'); ?>>

        <div class="entry-content">
    		<?php the_content(); ?>
    	</div>

        <div class="entry-header">
            <?php if ( has_post_thumbnail() ) : ?>
            <div class="entry-thumb">
                <?php the_post_thumbnail( 'wellness-thumbnail-avatar' ); ?>
            </div>
            <?php endif; ?>
            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
        </div>

</article><!-- #post-## -->
