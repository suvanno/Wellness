<?php
/**
 * Template Name: Front Page
 *
 * @package Wellness
 */
get_header(); ?>

	<div id="primary" class="content-area front-page">
		<main id="main" class="site-main" role="main">

			<?php wellness_featured_content_section(); ?>

			<?php wellness_featured_pages_section(); ?>

			<?php wellness_grid_page_section(); ?>

			<?php wellness_testimonial_section(); ?>

			<?php wellness_latest_news(); ?>

			<?php
			while ( have_posts() ) : the_post();

				if ( get_the_content() != '' ) {
					echo '<div class="front-page-content front-page-section">';
					get_template_part( 'template-parts/content', 'page' );
					echo '</div><!-- .front-page-content -->';
				}

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
