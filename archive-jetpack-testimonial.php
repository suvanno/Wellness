<?php
/**
 * Testimonials Archive Page
 *
 * @package Wellness
 */
get_header(); ?>

	<?php $jetpack_options = get_theme_mod( 'jetpack_testimonials' ); ?>

	<div id="primary" class="content-area full-width grid-page-content">
		<main id="main" class="site-main" role="main">

			<article class="hentry">
				<?php if ( isset( $jetpack_options['featured-image'] ) && '' != $jetpack_options['featured-image'] ) : ?>
					<div class="entry-thumbnail">
						<?php echo wp_get_attachment_image( (int)$jetpack_options['featured-image'], 'wellness-hero' ); ?>
					</div><!-- .thumbnail -->
				<?php endif; ?>

				<div class="entry-content-wrapper <?php if ( isset( $jetpack_options['featured-image'] ) && '' != $jetpack_options['featured-image'] ) echo 'has-thumbnail' ?>">
					<header class="entry-header">
						<h1 class="entry-title">
							<?php
							if ( isset( $jetpack_options['page-title'] ) && '' != $jetpack_options['page-title'] )
								echo esc_html( $jetpack_options['page-title'] );
							else
								esc_html_e( 'Testimonials', 'wellness' );
							?>
						</h1>
					</header><!-- .entry-header -->

					<?php if ( isset( $jetpack_options['page-content'] ) && '' != $jetpack_options['page-content'] ) : // only display if content not empty ?>
					<div class="entry-content">
						<?php echo convert_chars( convert_smilies( wptexturize( stripslashes( wp_filter_post_kses( addslashes( $jetpack_options['page-content'] ) ) ) ) ) ); ?>
					</div><!-- .entry-content -->
					<?php endif; ?>

					<?php if ( get_edit_post_link() ) : ?>
						<footer class="entry-footer clear">
							<?php
								edit_post_link(
									sprintf(
										/* translators: %s: Name of current post */
										esc_html__( 'Edit %s', 'wellness' ),
										the_title( '<span class="screen-reader-text">"', '"</span>', false )
									),
									'<span class="edit-link">',
									'</span>'
								);
							?>
						</footer><!-- .entry-footer -->
					<?php endif; ?>
				</div><!-- .entry-content-wrapper -->
			</article><!-- #post-## -->

			<?php if ( have_posts() ) : ?>

				<div id="testimonials" class="testimonials-grid">
						<div class="grid-row">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'template-parts/content', 'testimonial' ); ?>
						<?php endwhile; ?>
					</div><!-- .grid-row -->
				</div><!-- #testimonials -->

			<?php
				the_posts_navigation();
				endif;
				wp_reset_postdata();
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
