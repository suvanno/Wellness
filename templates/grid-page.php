<?php
/**
 * Template Name: Grid Page
 *
 * @package Wellness
 */
get_header(); ?>

	<div id="primary" class="content-area full-width grid-page-content">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
            <?php rewind_posts(); ?>
            <?php
        		$child_pages = new WP_Query( array(
        			'post_type'      => 'page',
        			'orderby'        => 'menu_order',
        			'order'          => 'ASC',
        			'post_parent'    => $post->ID,
        			'posts_per_page' => 999,
        			'no_found_rows'  => true,
        		) );
        	?>
            <?php if ( $child_pages->have_posts() ) : ?>

    		<div class="grid-area">
    			<div class="grid-row">
    				<?php while ( $child_pages->have_posts() ) : $child_pages->the_post(); ?>
    						<?php get_template_part( 'template-parts/content', 'grid' ); ?>
    				<?php endwhile; ?>
    			</div><!-- .grid-row -->
    		</div><!-- .grid-area -->

    	<?php
    		endif;
    		wp_reset_postdata();
    	?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
