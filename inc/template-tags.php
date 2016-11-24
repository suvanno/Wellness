<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Wellness
 */

if ( ! function_exists( 'wellness_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function wellness_entry_meta() {

	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . esc_html__( 'Featured', 'wellness' ) . '</span>';

	if ( ! is_sticky() ) {

		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>',
			esc_url( get_permalink() ),
			esc_attr( sprintf( __( 'Permalink to %s', 'wellness' ), the_title_attribute( 'echo=0' ) ) ),
			$time_string
		);
	}

	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
	echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'wellness' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'wellness_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function wellness_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'wellness' ) );
		if ( $categories_list && wellness_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'wellness' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'wellness' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'wellness' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'wellness' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function wellness_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'wellness_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'wellness_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so wellness_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so wellness_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in wellness_categorized_blog.
 */
function wellness_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'wellness_categories' );
}
add_action( 'edit_category', 'wellness_category_transient_flusher' );
add_action( 'save_post',     'wellness_category_transient_flusher' );

/**
 * Display featured content on Front Page though a slider.
 */
function wellness_featured_content_section() {
	$featured_posts = wellness_get_featured_posts();

	// if we have no posts, our work is done here.
	if ( empty( $featured_posts ) )
		return;

	?>
	<section id="featured-content-area" class="site-featured-content">
		<div class="featured-posts featured-posts-slider">

    		<?php foreach ( $featured_posts as $featured_post ) : setup_postdata( $GLOBALS['post'] =& $featured_post ); ?>
                <?php if ( has_post_thumbnail( ) ) { ?>
    			<?php get_template_part( 'template-parts/content', 'featured' ); ?>
                <?php } ?>
    		<?php endforeach; ?>

		</div><!-- .featured_posts-->
	</section><!-- #feature-content-area -->

	<?php wp_reset_postdata(); ?>

	<?php
}

/**
 * Display featured pages on Front Page Template.
 */
function wellness_featured_pages_section() {
	$featured_page_1 = esc_attr( get_theme_mod( 'wellness_featured_page_one_front_page', '0' ) );
	$featured_page_2 = esc_attr( get_theme_mod( 'wellness_featured_page_two_front_page', '0' ) );
	$featured_page_3 = esc_attr( get_theme_mod( 'wellness_featured_page_three_front_page', '0' ) );
	if ( 0 == $featured_page_1 && 0 == $featured_page_2 && 0 == $featured_page_3 ) {
		return;
	}
	?>

	<section id="featured-page-area" class="front-page-section">
		<div class="grid-row">

			<?php for ( $page_number = 1; $page_number <= 3; $page_number++ ) : ?>
				<?php if ( 0 != ${'featured_page_' . $page_number} ) : ?>
						<?php
							$featured_page_args = array(
								'page_id' => ${'featured_page_' . $page_number},
							);
							$featured_page_query = new WP_Query( $featured_page_args );
						?>

						<?php while ( $featured_page_query->have_posts() ) : $featured_page_query->the_post(); ?>

							<?php get_template_part( 'template-parts/content', 'grid' ); ?>

						<?php
							endwhile;
							wp_reset_postdata();
						?>
				<?php endif; ?>
			<?php endfor; ?>

		</div>
	</section><!-- #featured-page-area -->

	<?php
}

/**
 * Display grid page layout on Front Page Template.
 */
function wellness_grid_page_section() {
	$grid_page          = esc_attr( get_theme_mod( 'wellness_grid_page', '0' ) );
	$number_child_pages = absint( get_theme_mod( 'wellness_number_child_pages', '6' ) );
	$section_title      = esc_attr( get_theme_mod( 'wellness_grid_page_section_title' ) );
	$section_desc       = wp_kses_post( get_theme_mod( 'wellness_grid_page_section_desc' ) );

	// If we have no page, our work is done here.
	if ( 0 == $grid_page ) {
		return;
	}
	?>

	<section id="grid-page-area" class="front-page-section">

		<div class="section-header">
			<h2 class="section-title"><?php echo ( $section_title != '' ) ? $section_title : get_the_title( $grid_page ); ?></h2>
			<?php if ( $section_desc && $section_desc != '' ) echo '<div class="section-desc">' . $section_desc . '</div>'; ?>
		</div><!-- .section-header -->

		<?php
			$child_pages = new WP_Query( array(
				'post_type'      => 'page',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'post_parent'    => $grid_page,
				'posts_per_page' => $number_child_pages,
				'no_found_rows'  => true,
			) );
		?>
		<?php if ( $child_pages->have_posts() ) : ?>
			<div class="section-content">
				<div class="frontpage-grid-page grid-row">
					<?php while ( $child_pages->have_posts() ) : $child_pages->the_post(); ?>

						<?php if ( ! has_post_thumbnail() ) continue; ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('grid-sm-6 grid-md-4'); ?>>
							<div class="frontpage-grid-media">
								<?php the_post_thumbnail( 'wellness-thumbnail-landscape' ); ?></a>
								<div class="transition5">
									<div class="frontpage-grid-content">
										<?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
										<a class="btn-ghost" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'wellness' ); ?></a>
									</div>
								</div>
							</div> <!-- .grid-item-media -->
						</article><!-- #post-## -->

					<?php endwhile; ?>
				</div>
			</div> <!-- .section-content -->
		<?php
		endif;
		wp_reset_postdata();
		?>
	</section><!-- #grid-page-area -->

	<?php
}

/*
 * Display 4 random testimonials on Front Page template.
 */
function wellness_testimonial_section() {
	$testimonials = wellness_get_random_posts( 4, 'jetpack-testimonial' );
	$section_title = esc_html( get_theme_mod( 'wellness_testimonial_section_title', __( 'Our Happy Clients', 'wellness' ) ) );
	$testimonials_layout = esc_attr( get_theme_mod( 'wellness_testimonial_layout_front_page', 'slider' ) );

	if ( ! empty( $testimonials ) && 0 != get_theme_mod( 'wellness_testimonial_on_frontpage' ) ) :
		?>
		<section id="testimonials-area" class="<?php echo 'testimonials-' . $testimonials_layout . '-layout'; ?> front-page-section">

			<?php if ( $section_title != '' ) : ?>
			<div class="section-header">
				<h2 class="section-title"><?php echo $section_title; ?></h2>
			</div><!-- .section-header -->
			<?php endif; ?>

			<div class="section-content">
				<div class="testimonials-wrapper">

					<?php if ( $testimonials_layout == 'grid' ) { ?>

						<div class="testimonials-grid">
							<div class="grid-row">
								<?php
								foreach ( $testimonials as $testimonial ) : setup_postdata( $GLOBALS['post'] =& $testimonial );
									get_template_part( 'template-parts/content', 'testimonial' );
								endforeach;
								wp_reset_postdata();
								?>
							</div>
						</div><!-- .testimonials-grid -->

					<?php } else { ?>

						<div class="testimonials-slider">
								<?php
								foreach ( $testimonials as $testimonial ) : setup_postdata( $GLOBALS['post'] =& $testimonial );
									get_template_part( 'template-parts/content', 'testimonial-slide' );
								endforeach;
								wp_reset_postdata();
								?>
							</div>
						</div><!-- .testimonials-slider -->

					<?php } ?>

				</div><!-- .testimonials-wrapper -->
			</div><!-- .section-content -->

		</section><!-- #testimonials-area -->
		<?php
	endif;
}

/*
 * Display 4 latest posts on Front Page template.
 */
function wellness_latest_news() {
	$latest_posts = new WP_Query( array(
		'posts_per_page'      => 4,
		'no_found_rows'       => true,
		'ignore_sticky_posts' => true,
	) );
	$section_title = esc_html( get_theme_mod( 'wellness_latest_news_section_title', __( 'Latest News & Updates', 'wellness' ) ) );

	if ( $latest_posts->have_posts() && get_theme_mod( 'wellness_latest_news_on_frontpage' ) == '1' ) :
	?>
	<section id="latest-news-area" class="front-page-latest-news front-page-section">

		<?php if ( $section_title != '' ) : ?>
		<div class="section-header">
			<h2 class="section-title"><?php echo $section_title; ?></h2>
		</div><!-- .section-header -->
		<?php endif; ?>

		<div class="section-content clear">
				<?php
				while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
						<div class="entry-header">
							<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
						</div>
						<div class="entry-meta clear">
							<?php wellness_entry_meta(); ?>
						</div><!-- .entry-meta -->
						<div class="entry-excerpt">
							<?php the_excerpt(); ?>
						</div>

					</article><!-- #post-## -->
				<?php
				endwhile;
				wp_reset_postdata();
				?>
		</div><!-- .section-content -->
		<div class="more-recent-posts">
			<a class="btn" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">
				<?php esc_html_e( 'More Posts', 'wellness' ); ?>
			</a>
		</div>

		</div><!-- .section-content -->
	</section><!-- #latest-news-area -->
	<?php
	endif;
}
