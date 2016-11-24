( function( $ ) {

    // Initialize Topbar Search.
    $( '.search-toggle' ).on( 'click', function(){
        var _this            = $( this );
        $( '.header-search' ).toggleClass( 'header-search-toggled-on' );
        _this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
    });

    // Initialize Featured Content & Testimonial Slider
    if ( $().slick ) {
		$( '.featured-posts-slider' ).slick( {
            'rtl'            : ( jQuery( 'html' ).attr( 'dir' ) == 'rtl' ) ? true : false,
			'adaptiveHeight' : false,
			'autoplay'       : true,
			'autoplaySpeed'  : 5400,
			'cssEase'        : 'ease-in-out',
			'dots'           : false,
			'draggable'      : false,
			'easing'         : 'easeInOutBack',
			'fade'           : true,
			'pauseOnHover'   : true,
			'slide'          : 'article',
			'speed'          : 600,
			'swipeToSlide'   : true,
			'prevArrow'      : '<div class="slider-nav slider-nav-prev transition5"><button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button></div>',
			'nextArrow'      : '<div class="slider-nav slider-nav-next transition5"><button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button></div>'
		} );

        $( '.testimonials-slider' ).slick( {
            'rtl'            : ( jQuery( 'html' ).attr( 'dir' ) == 'rtl' ) ? true : false,
			'adaptiveHeight' : false,
			'autoplay'       : true,
			'autoplaySpeed'  : 5400,
			'cssEase'        : 'ease-in-out',
			'dots'           : false,
			'draggable'      : false,
			'easing'         : 'easeInOutBack',
			'fade'           : true,
			'pauseOnHover'   : true,
			'slide'          : 'article',
			'speed'          : 600,
			'swipeToSlide'   : true,
			'prevArrow'      : '<div class="slider-nav slider-nav-prev transition5"><button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button></div>',
			'nextArrow'      : '<div class="slider-nav slider-nav-next transition5"><button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button></div>'
		} );
	}

} )( jQuery );
