<?php
/**
 * Wellness Theme Customizer.
 *
 * @package Wellness
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wellness_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_panel( 'wellness_theme_options', array(
		'title'    => __( 'Theme Options', 'wellness' ),
		'priority' => 140,
	) );

	/* Front Page Template: Featured Pages Section */
	$wp_customize->add_section( 'wellness_featured_pages_section' ,
		array(
			'panel'       => 'wellness_theme_options',
			'title'       => esc_html__( 'Front Page: Features Pages Section', 'wellness' ),
			'description' => esc_html__( 'This section is designed to display up to 3 featured pages on the Front Page Template.', 'wellness' ),
		)
	);

		/* Featured Page One */
		$wp_customize->add_setting( 'wellness_featured_page_one_front_page', array(
			'default'           => '',
			'sanitize_callback' => 'wellness_sanitize_dropdown_pages',
		) );
		$wp_customize->add_control( 'wellness_featured_page_one_front_page', array(
			'label'             => esc_html__( 'Featured Page One', 'wellness' ),
			'section'           => 'wellness_featured_pages_section',
			'priority'          => 5,
			'type'              => 'dropdown-pages',
		) );

		/* Featured Page Two */
		$wp_customize->add_setting( 'wellness_featured_page_two_front_page', array(
			'default'           => '',
			'sanitize_callback' => 'wellness_sanitize_dropdown_pages',
		) );
		$wp_customize->add_control( 'wellness_featured_page_two_front_page', array(
			'label'             => esc_html__( 'Featured Page Two', 'wellness' ),
			'section'           => 'wellness_featured_pages_section',
			'priority'          => 7,
			'type'              => 'dropdown-pages',
		) );

		/* Featured Page Three */
		$wp_customize->add_setting( 'wellness_featured_page_three_front_page', array(
			'default'           => '',
			'sanitize_callback' => 'wellness_sanitize_dropdown_pages',
		) );
		$wp_customize->add_control( 'wellness_featured_page_three_front_page', array(
			'label'             => esc_html__( 'Featured Page Three', 'wellness' ),
			'section'           => 'wellness_featured_pages_section',
			'priority'          => 9,
			'type'              => 'dropdown-pages',
		) );

	/* Front Page Template: Grid Pages Section */
	$wp_customize->add_section( 'wellness_grid_page_section' ,
		array(
			'panel'       => 'wellness_theme_options',
			'title'       => esc_html__( 'Front Page: Grid Page Section', 'wellness' ),
			'description' => esc_html__( 'This section is designed to display a grid layout of pages on the Front Page Template, you need to select a page that has child pages. Please note only child pages width featured image will be displayed.', 'wellness' ),
		)
	);
		/* Grid Page page */
		$wp_customize->add_setting( 'wellness_grid_page', array(
			'default'           => '',
			'sanitize_callback' => 'wellness_sanitize_dropdown_pages',
		) );
		$wp_customize->add_control( 'wellness_grid_page', array(
			'label'             => esc_html__( 'Select Page', 'wellness' ),
			'section'           => 'wellness_grid_page_section',
			'priority'          => 5,
			'type'              => 'dropdown-pages',
		) );

		/* Number of child page to show */
		$wp_customize->add_setting( 'wellness_number_child_pages', array(
			'default'           => '6',
			'sanitize_callback' => 'wellness_sanitize_number_absint',
		) );
		$wp_customize->add_control( 'wellness_number_child_pages', array(
			'label'             => esc_html__( 'Number of child pages to show', 'wellness' ),
			'section'           => 'wellness_grid_page_section',
			'priority'          => 7,
		) );

		/* Custom Section Title */
		$wp_customize->add_setting( 'wellness_grid_page_section_title', array(
			'default'           => '',
			'sanitize_callback' => 'wellness_sanitize_text',
		) );
		$wp_customize->add_control( 'wellness_grid_page_section_title', array(
			'label'             => esc_html__( 'Custom section title', 'wellness' ),
			'section'           => 'wellness_grid_page_section',
			'priority'          => 9,
			'description'		=> esc_html__( 'If empty, the title of the page you selected above will be use instead.', 'wellness' )
		) );

		/* Custom Section Description */
		$wp_customize->add_setting( 'wellness_grid_page_section_desc', array(
			'default'           => '',
			'sanitize_callback' => 'wellness_sanitize_html',
		) );
		$wp_customize->add_control( 'wellness_grid_page_section_desc', array(
			'label'             => esc_html__( 'Custom section description', 'wellness' ),
			'section'           => 'wellness_grid_page_section',
			'priority'          => 11,
			'type'     			=> 'textarea'
		) );

	/* Front Page Template: Testimonial Section */
	$wp_customize->add_section( 'wellness_testimonial_section' ,
		array(
			'panel'       => 'wellness_theme_options',
			'title'       => esc_html__( 'Front Page: Testimonial Section', 'wellness' ),
		)
	);

		/* Show Testimonial */
		$wp_customize->add_setting( 'wellness_testimonial_on_frontpage', array(
			'default'           => '',
			'sanitize_callback' => 'wellness_sanitize_checkbox',
		) );
		$wp_customize->add_control( 'wellness_testimonial_on_frontpage', array(
			'label'             => esc_html__( 'Display Testimonials', 'wellness' ),
			'section'           => 'wellness_testimonial_section',
			'priority'          => 5,
			'type'              => 'checkbox',
			'description'		=> esc_html__( 'If left checked then four random testimonials will be display on the Front Page template.', 'wellness' ),
		) );

		/* Custom Section Title */
		$wp_customize->add_setting( 'wellness_testimonial_section_title', array(
			'default'           => esc_html__('Our Happy Clients', 'wellness'),
			'sanitize_callback' => 'wellness_sanitize_text',
		) );
		$wp_customize->add_control( 'wellness_testimonial_section_title', array(
			'label'             => esc_html__( 'Testimonial section title', 'wellness' ),
			'section'           => 'wellness_testimonial_section',
			'priority'          => 7,
		) );

		/* Front page testimonials layout */
		$wp_customize->add_setting( 'wellness_testimonial_layout_front_page', array(
			'default'           => 'slider',
			'sanitize_callback' => 'wellness_sanitize_front_page_testimonial_layout',
		) );
		$wp_customize->add_control( 'wellness_testimonial_layout_front_page', array(
			'label'             => esc_html__( 'Testimonials Layout', 'wellness' ),
			'section'           => 'wellness_testimonial_section',
			'priority'          => 9,
			'type'              => 'radio',
			'description'		=> esc_html__( 'Choose the testimonial layout on Front Page template.', 'wellness' ),
			'choices'           => array(
				'slider' => esc_html__( 'Slider', 'wellness' ),
				'grid'   => esc_html__( 'Grid', 'wellness' ),
			),
		) );

	/* Front Page Template: Latest News Section */
	$wp_customize->add_section( 'wellness_latest_news_section' ,
		array(
			'panel'       => 'wellness_theme_options',
			'title'       => esc_html__( 'Front Page: Latest News Section', 'wellness' ),
		)
	);

		/* Show Latest News */
		$wp_customize->add_setting( 'wellness_latest_news_on_frontpage', array(
			'default'           => '1',
			'sanitize_callback' => 'wellness_sanitize_checkbox',
		) );
		$wp_customize->add_control( 'wellness_latest_news_on_frontpage', array(
			'label'             => esc_html__( 'Display latest news section', 'wellness' ),
			'section'           => 'wellness_latest_news_section',
			'priority'          => 5,
			'type'              => 'checkbox',
			'description'		=> esc_html__( 'If left checked then four latest posts will be display in a grid layout on the Front Page template.', 'wellness' ),
		) );
		/* Custom Section Title */
		$wp_customize->add_setting( 'wellness_latest_news_section_title', array(
			'default'           => esc_html__('Latest News & Updates', 'wellness'),
			'sanitize_callback' => 'wellness_sanitize_text',
		) );
		$wp_customize->add_control( 'wellness_latest_news_section_title', array(
			'label'             => esc_html__( 'Latest news section title', 'wellness' ),
			'section'           => 'wellness_latest_news_section',
			'priority'          => 7,
		) );

	/* General Settings */
	$wp_customize->add_section( 'wellness_general_options' ,
		array(
			'panel'       => 'wellness_theme_options',
			'title'       => esc_html__( 'General Settings', 'wellness' ),
		)
	);
		/* Sidebar Position */
		$wp_customize->add_setting( 'wellness_sidebar_position', array(
			'default'           => 'right',
			'sanitize_callback' => 'wellness_sanitize_sidebar_position',
		) );
		$wp_customize->add_control( 'wellness_sidebar_position', array(
			'label'             => esc_html__( 'Sidebar Position', 'wellness' ),
			'section'           => 'wellness_general_options',
			'priority'          => 2,
			'type'              => 'radio',
			'choices'           => array(
				'left'  => __( 'Left', 'wellness' ),
				'right' => __( 'Right', 'wellness' ),
			),
		) );

}
add_action( 'customize_register', 'wellness_customize_register' );

/**
 * Sanitize the dropdown pages.
 */
function wellness_sanitize_dropdown_pages( $input ) {
	if ( is_numeric( $input ) ) {
		return intval( $input );
	}
}

/**
 * Sanitize the Testimonial Layout on front page.
 */
function wellness_sanitize_front_page_testimonial_layout( $layout ) {
	if ( ! in_array( $layout, array( 'slider', 'grid' ) ) ) {
		$layout = 'slider';
	}
	return $layout;
}

/**
 * Sanitize the Sidebar Position.
 */
function wellness_sanitize_sidebar_position( $position ) {
	if ( ! in_array( $position, array( 'left', 'right' ) ) ) {
		$position = 'right';
	}
	return $position;
}

/**
 * Sanitize callback for 'html' type text inputs. This callback sanitizes `$html` for HTML allowable in posts.
 */
function wellness_sanitize_html( $string ) {
	return wp_filter_post_kses( $string );
}

/**
 * Sanitization callback for 'number' type text inputs. This callback sanitizes `$number`
 * as an absolute integer (whole number, zero or greater).
 */
function wellness_sanitize_number_absint( $number, $setting ) {
	$number = absint( $number );
	return ( $number ? $number : $setting->default );
}


/**
 * Sanitize the text input.
 */
function wellness_sanitize_text( $string ) {
	return wp_kses_post( balanceTags( $string ) );
}

/**
 * Sanitize the checkbox.
 */
function wellness_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wellness_customize_preview_js() {
	wp_enqueue_script( 'wellness_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'wellness_customize_preview_js' );
