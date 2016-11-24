<?php
/**
 * Template part for displaying posts.
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
			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta clear">
				<?php wellness_entry_meta(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wellness' ) ); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'wellness' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php endif; ?>
		<footer class="entry-footer clear">
			<?php wellness_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-content-wrapper -->
</article><!-- #post-## -->
