<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wellness
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="entry-thumbnail">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_post_thumbnail( 'wellness-featured-image' ); ?></a>
	</div>
	<?php endif; ?>
	<div class="entry-content-wrapper <?php if ( has_post_thumbnail() ) echo 'has-thumbnail' ?>">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta clear">
				<?php wellness_entry_meta(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-footer clear">
			<?php wellness_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-content-wrapper -->
</article><!-- #post-## -->
