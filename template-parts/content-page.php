<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wellness
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="entry-thumbnail">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>">
			<?php
			if ( is_page_template( 'templates/full-width-page.php') || is_page_template( 'templates/grid-page.php' ) ) {
				the_post_thumbnail( 'wellness-hero' );
			} else {
				the_post_thumbnail( 'wellness-featured-image' );
			}
			?>
		</a>
	</div>
	<?php endif; ?>
	<div class="entry-content-wrapper <?php if ( has_post_thumbnail() ) echo 'has-thumbnail' ?>">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wellness' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

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
