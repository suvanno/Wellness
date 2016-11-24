<?php
/**
 * The template used for displaying featured page content in page-templates/front-page.php and page-templates/grid-page.php
 *
 * @package Wellness
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('grid-md-4'); ?>>
	<div class="grid-item-wrapper">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="grid-item-thumbnail">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'wellness-thumbnail-landscape' ); ?></a>
		</div> <!-- .grid-item-thumbnail -->
		<?php endif; ?>

		<div class="grid-item-content <?php if ( has_post_thumbnail() ) echo 'has-thumbnail' ?>">
			<?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
			<?php the_excerpt(); ?>
			<div class="grid-item-more transition5">
				<a class="btn-ghost" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'wellness' ); ?></a>
			</div>
		</div> <!-- .grid-item-content -->
	</div><!-- .grid-item-wrapper -->
</article><!-- #post-## -->
